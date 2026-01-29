<?php

namespace App\Http\Controllers;

use App\Models\Dostavljac;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DostavljacController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Dostavljac::all();
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
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ime' => 'required|string|max:30',
            'kontakt' => 'required|string|max:15',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Neuspešna validacija',
                'errors' => $validator->errors()
            ], 422);
        }

        $dostavljac = Dostavljac::create($validator->validated());
        return response()->json($dostavljac, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return Dostavljac::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dostavljac $dostavljac)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    //ovo sluzi za 
    public function update(Request $request,$id)
    {
       
        $dostavljac = Dostavljac::find($id);
        if (!$dostavljac) {
            return response()->json(['message' => 'Dostavljač nije pronađen'], 404);
        }

        $validator = Validator::make($request->all(), [
            'ime' => 'sometimes|required|string|max:30',
            'kontakt' => 'sometimes|required|string|max:15',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Neuspešna validacija',
                'errors' => $validator->errors()
            ], 422);
        }

        $dostavljac->update($validator->validated());
        return response()->json($dostavljac, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $dostavljac = Dostavljac::find($id);
        if (!$dostavljac) {
            return response()->json(['message' => 'Dostavljač nije pronađen'], 404);
        }

        $dostavljac->delete();
        return response()->json(['message' => 'Dostavljač je uspešno obrisan'], 200);
    }
}
