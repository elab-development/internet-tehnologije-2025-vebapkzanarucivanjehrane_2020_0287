<?php

namespace App\Http\Controllers;

use App\Models\Recenzija;
use App\Models\Korisnik;
use App\Models\Restoran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RecenzijaController extends Controller
{
    public function index()
    {
        return response()->json(Recenzija::all(), 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'korisnik_id' => 'required|integer|exists:users,korisnik_id',
            'restoran_id' => 'required|integer|exists:restorani,restoran_id',
            'ocena' => 'required|integer|min:1|max:5',
            'komentar' => 'required|string|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        $data = $validator->validated();
        $recenzija = Recenzija::create($data);

        return response()->json($recenzija, 201);
    }

    public function show($id)
    {
        return Recenzija::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $recenzija = Recenzija::find($id);
        if (!$recenzija) {
            return response()->json(['message' => 'Recenzija not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'korisnik_id' => 'sometimes|required|integer|exists:users,korisnik_id',
            'restoran_id' => 'sometimes|required|integer|exists:restorani,restoran_id',
            'ocena' => 'sometimes|required|integer|min:1|max:5',
            'komentar' => 'sometimes|required|string|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }


        $recenzija->update($validator->validated());
        return response()->json($recenzija, 200);
    }

    public function destroy($id)
    {
        $recenzija = Recenzija::find($id);
        if (!$recenzija) {
            return response()->json(['message' => 'Recenzija not found'], 404);
        }
        
        $recenzija->delete();
        return response()->json(['message' => 'Recenzija obrisana'], 200);
    }
}
