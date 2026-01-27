<?php

namespace App\Http\Controllers;

use App\Models\StavkaPorudzbine;
use App\Models\Porudzbina;
use App\Models\Jelo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StavkaPorudzbineController extends Controller
{
    public function index()
    {
        return StavkaPorudzbine::all();
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'porudzbina_id' => 'required|integer|exists:porudzbine,porudzbina_id',
            'jelo_id' => 'required|integer|exists:jela,jelo_id',
            'kolicina' => 'required|integer|min:1',
            'cena' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        $data = $validator->validated();
        $stavka = StavkaPorudzbine::create($data);

        return response()->json($stavka, 201);
    }

    public function show($id)
    {
        return StavkaPorudzbine::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $stavka = StavkaPorudzbine::find($id);
        if (!$stavka) {
            return response()->json(['message' => 'Stavka not found'], 404);
        }
        $validator = Validator::make($request->all(), [
            'porudzbina_id' => 'sometimes|integer|exists:porudzbine,porudzbina_id',
            'jelo_id' => 'sometimes|integer|exists:jela,jelo_id',
            'kolicina' => 'sometimes|integer|min:1',
            'cena' => 'sometimes|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        $data = $validator->validated();
        $stavka->update($data);

        return response()->json($stavka, 200);
    }

    public function destroy($id)
    {
        $stavkaPorudzbine = StavkaPorudzbine::find($id);
        if (!$stavkaPorudzbine) {
            return response()->json(['message' => 'Stavka not found'], 404);
        }
    {
        $stavkaPorudzbine->delete();
        return response()->json(['message' => 'Stavka obrisana'], 200);
    }
}
}