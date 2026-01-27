<?php

namespace App\Http\Controllers;

use App\Models\StavkaPorudzbine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StavkaPorudzbineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return StavkaPorudzbine::all();
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
            'kolicina' => 'required|integer|min:1',
            'jelo_id' => 'required|exists:jela,id',
            'porudzbina_id' => 'required|exists:porudzbine,id',
            'cena' => $jelo->cena * $request->kolicina,
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Neuspešna validacija',
                'errors' => $validator->errors()
            ], 422);
        }

        $stavkaPorudzbine = StavkaPorudzbine::create($request->all());
        return response()->json($stavkaPorudzbine, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return StavkaPorudzbine::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StavkaPorudzbine $stavkaPorudzbine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $stavkaPorudzbine = StavkaPorudzbine::find($id);
        if (!$stavkaPorudzbine) {
            return response()->json(['message' => 'Stavka porudžbine nije pronađena'], 404);
        }

        $validator = Validator::make($request->all(),[
            'kolicina' => 'sometimes|required|integer|min:1',
            'jelo_id' => 'sometimes|required|exists:jela,id',
            'porudzbina_id' => 'sometimes|required|exists:porudzbine,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Neuspešna validacija',
                'errors' => $validator->errors()
            ], 422);
        }

        $stavkaPorudzbine->update($validator->validated());
        return response()->json($stavkaPorudzbine, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
      $stavkaPorudzbine = StavkaPorudzbine::find($id);
        if (!$stavkaPorudzbine) {
            return response()->json(['message' => 'Stavka porudžbine nije pronađena'], 404);
        }  
        
        $stavkaPorudzbine->delete();
        return response()->json(['message' => 'Stavka porudžbine je uspešno obrisana'], 200);
    }
}
