<?php

namespace App\Http\Controllers;

use App\Models\Porudzbina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PorudzbinaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Porudzbina::all();
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
        $validator = Validator::make($request->all(),[
            'datum' => 'required|date',
            'ukupna_cena' => 'required|numeric|min:0',
            'restoran_id' => 'required|exists:restorani,id',
            'dostavljac_id' => 'required|exists:dostavljaci,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Neuspešna validacija',
                'errors' => $validator->errors()
            ], 422);
        }

        $porudzbina = Porudzbina::create($request->all());
        return response()->json($porudzbina, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return Porudzbina::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Porudzbina $porudzbina)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Porudzbina $porudzbina)
    {
        $validator = Validator::make($request->all(),[
            'datum' => 'sometimes|required|date',
            'ukupna_cena' => 'sometimes|required|numeric|min:0',
            'restoran_id' => 'sometimes|required|exists:restorani,id',
            'dostavljac_id' => 'sometimes|required|exists:dostavljaci,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Neuspešna validacija',
                'errors' => $validator->errors()
            ], 422);
        }

        $porudzbina->update($request->all());
        return response()->json($porudzbina, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $porudzbina = Porudzbina::find($id);
        if (!$porudzbina) {
            return response()->json(['message' => 'Porudžbina nije pronađena'], 404);
        }  

        $porudzbina->delete();
        return response()->json(['message' => 'Porudžbina je uspešno obrisana'], 200);
    }
}
