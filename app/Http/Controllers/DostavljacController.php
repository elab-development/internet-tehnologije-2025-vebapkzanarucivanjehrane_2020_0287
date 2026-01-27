<?php

namespace App\Http\Controllers;

use App\Models\Dostavljac;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\DostavljacResource;



class DostavljacController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    //get all dostavljaci
    //index se koristi za prikaz svih dostavljaca
    public function index()
    {
        return Dostavljac::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    //create se koristi za prikaz forme za kreiranje novog dostavljaca
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    //post new dostavljac
    //request se koristi za dobijanje podataka iz zahteva
    public function store(Request $request)
    {
        //  
        $validator = Validator::make($request->all(), [
            'ime' => 'required|string|max:255',
            'kontakt' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
            'message' => 'Validation failed', 
            'errors' => $validator->errors()
            ], 422);
        }
        $data = $validator->validated();
        $dostavljac = Dostavljac::create($data);
        return response()->json($dostavljac, 201);


    }

    /**
     * Display the specified resource.
     */ 
    //show se koristi za prikaz jednog dostavljaca sa prosledjenim id-jem

    public function show($id)
    {
        return new DostavljacResource(Dostavljac::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dostavljac $dostavljac)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    //update se koristi za azuriranje podataka o dostavljacu
    public function update(Request $request, $id)
    {
        $dostavljac = Dostavljac::find($id);
        if (!$dostavljac) {
            return response()->json(['message' => 'Dostavljac not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'ime' => 'sometimes|required|string|max:255',
            'kontakt' => 'sometimes|required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
            'message' => 'Validation failed', 
            'errors' => $validator->errors()
            ], 422);
        }

        $data = $validator->validated();
        $dostavljac->update($data);
        return response()->json($dostavljac, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    //destroy se koristi za brisanje dostavljaca
    public function destroy($id)
    {
        $dostavljac = Dostavljac::find($id);
        if (!$dostavljac) {
            return response()->json(['message' => 'Dostavljac not found'], 404);
        }
        $dostavljac->delete();
        return response()->json(['message' => 'Dostavljac deleted successfully'], 200);
    }
}
