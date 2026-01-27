<?php

namespace App\Http\Controllers;

use App\Models\Jelo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JeloController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    //ovo je ruta za dobijanje svih jela
    //GET /api/jela
    public function index()
    {
        return Jelo::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    //POST /api/jela
    //request se koristi za dobijanje podataka iz zahteva
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'restoran_id' => 'required|integer|exists:restorani,id',
            'naziv' => 'required|string|max:255',
            'opis' => 'nullable|string',
            'cena' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
            'message' => 'Validation failed', 
            'errors' => $validator->errors()
            ], 422);
        }
        $data = $validator->validated();
        $jelo = Jelo::create($data);
        return response()->json($jelo, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return Jelo::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jelo $jelo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $jelo = Jelo::find($id);
        if (!$jelo) {
            return response()->json(['message' => 'Jelo not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'restoran_id' => 'sometimes|required|integer|exists:restorani,id',
            'naziv' => 'sometimes|required|string|max:255',
            'opis' => 'sometimes|nullable|string',
            'cena' => 'sometimes|required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $validator->validated();
        $jelo->update($data);
        return response()->json($jelo, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $jelo = Jelo::find($id);
        if (!$jelo) {
            return response()->json(['message' => 'Jelo not found'], 404);
        }
        $jelo->delete();
        return response()->json(['message' => 'Jelo deleted successfully'], 200);
    }
}
