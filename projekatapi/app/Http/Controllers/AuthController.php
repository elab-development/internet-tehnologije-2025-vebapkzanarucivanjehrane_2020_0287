<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Dostavljac;


class AuthController extends Controller
{
    //ovo ce koristiti POST zahtev za registraciju korisnika /api/register
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ime' => 'required|string|max:255',
            'prezime' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'kontakt' => 'nullable|string|max:255' //optionalno jer korisnik moze biti kupac koji nema kontakt polje
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()], 422);
        }
        $data = $validator->validated();
        $user = User::create([
            'ime' => $data['ime'],
            'prezime' => $data['prezime'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        if($user['role'] === 'dostavljac'){
            //ako je uloga dostavljac, kreiramo i unos u tabeli dostavljaci
            Dostavljac::create([
                'user_id' => $user->id,
                'ime' => $user['ime'],
                'kontakt' => $user['kontakt'] ?? '', //ako nije prosledjen kontakt, stavlja se prazan string
            ]);
        }

        //token predstavlja nacin da se korisnik autentifikuje u API-ju
        //kao rezultat registracije, kreiramo token za korisnika
        $token = $user->createToken('api_token')->plainTextToken; //tekstualni token
        
        return response()->json([
        'message' => 'Uspešna registracija korisnika.',    
        'user' => $user,
        'access_token' => $token,
        ], 201);
    }

    // login method for user authentication, takodje POST zahtev /api/login
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Neuspešna validacija podataka.',
                'errors' => $validator->errors()], 422);
        }

        //ako validator ne fail-uje, ovo proverava da li su kredencijali ispravni
        //proverava da li postoji korisnik sa datim email-om i password-om
        if(!Auth::attempt($validator->validated())){
            return response()->json(['message' => 'Pogrešni kredencijali'], 401);
        }
        

        /** @var \App\Models\User $user */
        $user = Auth::user();   
        $token = $user->createToken('api_token')->plainTextToken;
        return response()->json([
            'message' => 'Uspešno ste prijavljeni.',
            'user' => $user,
            'role' => $user->role,
            'access_token' => $token,
        ], 200);    
    }
//logout metoda za odjavljivanje korisnika - POST zahtev /api/logout
//korisnik je vec prijavljen i ima validan token, tako da se token samo brise
    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Korisnik je uspešno odjavljen'], 200);
    }

    //metoda za dobijanje informacija o trenutno prijavljenom korisniku 
    //ovo je GET zahtev GET /api/me
    public function me(Request $request){
        return response()->json(['user' => $request->user()], 200);
    }


}