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
            'user_id'         => 'required|exists:users,id', 
        'dostavljac_id'   => 'nullable|exists:dostavljaci,id',
        'vreme_kreiranja' => 'required|date',
        'status'          => 'sometimes|in:na_cekanju,u_pripremi,dostava_u_toku,isporuceno,otkazano',
        'ukupna_cena'     => 'required|numeric|min:0',
        'adresa_isporuke' => 'required|string|max:255',
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
        return Porudzbina::findOrFail($id);
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
    public function update(Request $request, $id)
    {
        $porudzbina = Porudzbina::find($id);
        if (!$porudzbina) {
            return response()->json(['message' => 'Porudžbina nije pronađena'], 404);
        }

        $validator = Validator::make($request->all(),[
            'user_id'         => 'sometimes|exists:users,id', 
        'dostavljac_id'   => 'nullable|exists:dostavljaci,id',
        'vreme_kreiranja' => 'sometimes|date',
        'status'          => 'sometimes|in:na_cekanju,u_pripremi,dostava_u_toku,isporuceno,otkazano',
        'ukupna_cena'     => 'sometimes|numeric|min:0',
        'adresa_isporuke' => 'sometimes|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Neuspešna validacija',
                'errors' => $validator->errors()
            ], 422);
        }

        $porudzbina->update($validator->validated());
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
