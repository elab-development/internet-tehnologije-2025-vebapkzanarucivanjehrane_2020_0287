<?php

namespace App\Http\Controllers;

use App\Models\Recenzija;
use App\Models\Restoran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class RecenzijaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Recenzija::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request , $id)
{
    $validator = Validator::make($request->all(), [
        'ocena' => 'required|integer|min:1|max:5',
        'komentar' => 'nullable|string|max:200',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'message' => 'Neuspešna validacija',
            'errors' => $validator->errors()
        ], 422);
    }

    $recenzija = Recenzija::create([
        'user_id' => Auth::id(),
        'restoran_id' => $id, 
        'ocena' => $request->ocena,
        'komentar' => $request->komentar,
    ]);

    $prosecnaOcena = Recenzija::where('restoran_id', $recenzija->restoran_id)
        ->avg('ocena');

    Restoran::where('id', $recenzija->restoran_id)
        ->update([
            'prosecna_ocena' => round($prosecnaOcena, 2)
        ]);

    return response()->json($recenzija, 201);
}

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return Recenzija::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recenzija $recenzija)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $recenzija = Recenzija::find($id);
        if (!$recenzija) {
            return response()->json(['message' => 'Recenzija nije pronađena'], 404);
        }

        $validator = Validator::make($request->all(), [
            'ocena' => 'sometimes|required|integer|min:1|max:5',
            'komentar' => 'sometimes|nullable|string|max:200',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Neuspešna validacija',
                'errors' => $validator->errors()
            ], 422);
        }

        $recenzija->update($validator->validated());
        return response()->json($recenzija, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $recenzija = Recenzija::find($id);
        if (!$recenzija) {
            return response()->json(['message' => 'Recenzija nije pronađena'], 404);
        }

        $recenzija->delete();
        return response()->json(['message' => 'Recenzija je uspešno obrisana'], 200);
    }
}
