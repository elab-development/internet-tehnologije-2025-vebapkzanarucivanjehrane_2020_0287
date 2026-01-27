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
    //get all restorani
    public function index()
    {
        return Restoran::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    //create se koristi za prikaz forme za kreiranje novog restorana
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    //post new restoran 
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'naziv' => 'required|string|max:255',
            'adresa' => 'required|string|max:255',
            'telefon' => 'required|string|max:20',
        ]);
        if ($validator->fails()) {
            return response()->json([
            'message' => 'Validation failed', 
            'errors' => $validator->errors()
            ], 422);
        }
        $data = $validator->validated();
        $restoran = Restoran::create($data);
        return response()->json($restoran, 201);    

    }

    /**
     * Display the specified resource.
     */
    //get restoran by id
    public function show($id)
    {
        return Restoran::with('jela', 'recenzije')->findOrFail($id);
    }
    /**
     * Show the form for editing the specified resource.
     */
    //edit se koristi za prikaz forme za izmenu restorana
    public function edit(Restoran $restoran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    //put restoran by id  
    public function update(Request $request, $id)
    {
        $restoran = Restoran::find($id);
        if (!$restoran) {
            return response()->json(['message' => 'Restoran not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'naziv' => 'sometimes|required|string|max:255',
            'adresa' => 'sometimes|required|string|max:255',
            'telefon' => 'sometimes|required|string|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json([
            'message' => 'Validation failed', 
            'errors' => $validator->errors()
            ], 422);
        }

        $data = $validator->validated();
        $restoran->update($data);
        return response()->json($restoran, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $restoran = Restoran::find($id);
        if (!$restoran) {
            return response()->json(['message' => 'Restoran not found'], 404);
        }
        $restoran->delete();
        return response()->json(['message' => 'Restoran deleted successfully'], 200);
    }
}
