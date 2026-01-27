<?php

namespace App\Http\Controllers;

use App\Models\Porudzbina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PorudzbinaController extends Controller
{
    public function index()
    {
        return Porudzbina::all();
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'korisnik_id' => 'required|integer|exists:users,korisnik_id',
            'dostavljac_id' => 'required|integer|exists:dostavljaci,dostavljac_id',
            'vreme_kreiranja' => 'required|datetime',
            'status' => 'required|string|max:50',
            'ukupna_cena' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        $data = $validator->validated();
        $porudzbina = Porudzbina::create($data);

        return response()->json($porudzbina, 201);
    }

    public function show($id)
    {
        return Porudzbina::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $porudzbina = Porudzbina::find($id);
        if (!$porudzbina) {
            return response()->json(['message' => 'Porudzbina not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'korisnik_id' => 'sometimes|required|integer|exists:users,korisnik_id',
            'dostavljac_id' => 'sometimes|required|integer|exists:dostavljaci,dostavljac_id',
            'vreme_kreiranja' => 'sometimes|required|datetime',
            'status' => 'sometimes|required|string|max:50',
            'ukupna_cena' => 'sometimes|required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        $porudzbina->update($validator->validated());
        return response()->json($porudzbina, 200);
    }

    public function destroy($id)
    {
        $porudzbina = Porudzbina::find($id);
        if (!$porudzbina) {
            return response()->json(['message' => 'Porudzbina not found'], 404);
        }
        
        $porudzbina->delete();
        return response()->json(['message' => 'Porudzbina obrisana'], 200);
    }
}
