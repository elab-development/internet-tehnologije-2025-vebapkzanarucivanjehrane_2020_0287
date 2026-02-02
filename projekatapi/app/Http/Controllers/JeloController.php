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
    public function index()
    {
        return Jelo::all();
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
            'naziv' => 'required|string|max:50',
            'opis' => 'nullable|string',
            'cena' => 'required|numeric|min:0',
            'restoran_id' => 'required|exists:restorani,id',
        ]); 

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Neuspešna validacija',
                'errors' => $validator->errors()
            ], 422);
        }

        $jelo = Jelo::create($request->all());
        return response()->json($jelo, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return Jelo::find($id);
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
            return response()->json(['message' => 'Jelo nije pronađeno'], 404);
        }

        $validator = Validator::make($request->all(), [
            'naziv' => 'sometimes|required|string|max:50',
            'opis' => 'nullable|string',
            'cena' => 'sometimes|required|numeric|min:0',
            'restoran_id' => 'sometimes|required|exists:restorani,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Neuspešna validacija',
                'errors' => $validator->errors()
            ], 422);
        }

        $jelo->update($validator->validated());
        return response()->json($jelo, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $jelo = Jelo::find($id);
        if (!$jelo) {
            return response()->json(['message' => 'Jelo nije pronađeno'], 404);
        }
        
        $jelo->delete();
        return response()->json(['message' => 'Jelo je uspešno obrisano'], 200);
    }

    public function jelaZaRestoran($restoranId)
    {
        $jela = Jelo::where('restoran_id', $restoranId)->get();
        return response()->json($jela, 200);
    }
}