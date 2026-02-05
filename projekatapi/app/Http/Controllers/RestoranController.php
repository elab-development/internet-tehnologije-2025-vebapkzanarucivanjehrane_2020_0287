<?php

namespace App\Http\Controllers;

use App\Models\Restoran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RestoranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return Restoran::withAvg('recenzije', 'ocena')->get(); //racuna nam prosecnu ocenu
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
            'naziv' => 'required|string|max:30',
            'lokacija' => 'required|string|max:50',
            'aktivan' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Neuspešna validacija',
                'errors' => $validator->errors()
            ], 422);
        }

        $restoran = Restoran::create($request->all());
        return response()->json($restoran, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
       $restoran = Restoran::with('recenzije.korisnik')->find($id);
        return $restoran;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Restoran $restoran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $restoran = Restoran::find($id);
        if (!$restoran) {
            return response()->json(['message' => 'Restoran nije pronađen'], 404);
        }

        $validator = Validator::make($request->all(), [
            'naziv' => 'sometimes|required|string|max:30',
            'lokacija' => 'sometimes|required|string|max:50',
            'aktivan' => 'sometimes|required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Neuspešna validacija',
                'errors' => $validator->errors()
            ], 422);
        }

        $restoran->update($validator->validated());
        return response()->json($restoran, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
       $restoran = Restoran::find($id);
         if(!$restoran){
            return response()->json(['message' => 'Restoran nije pronađen'], 404);
         }

        $restoran->delete();
        return response()->json(['message' => 'Restoran je uspešno obrisan'], 200);
    }
}