<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\postJson;
use function Pest\Laravel\getJson;

uses(RefreshDatabase::class); //pre svakog testa ocistimo bazu, da testovi ne bi uticali jedni na druge

//Test za registraciju korisnika
test('korisnik se moze registrovati', function () {
    $response = postJson('/api/register', [ //saljemo zahtev na /api/register da vidimo da li se korisnik moze registrovati
        'ime' => 'Ana',
        'prezime' => 'Petrovic',
        'email' => 'ana@test.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ]);

    $response->assertStatus(201);   //ocekujemo status 201, jer je korisnik uspesno registrovan
    $response->assertJsonStructure(['access_token']);  //ocekujemo da odgovor sadrzi i token
});

//Test za prijavu korisnika
test('korisnik se moze prijaviti', function () {
    $user = User::factory()->create([   //prvo kreiramo korisnika u bazi, da bismo mogli testirati prijavu
        'email' => 'test@test.com',
        'password' => bcrypt('password123'), //bycrypt je funkcija za hashovanje lozinke
    ]);

    $response = postJson('/api/login', [ //saljemo zahtev na /api/login da vidimo da li se korisnik moze prijaviti
        'email' => 'test@test.com',
        'password' => 'password123',
    ]);

    $response->assertStatus(200); //ocekujemo status 200, jer je korisnik uspesno prijavljen
    $response->assertJsonStructure(['access_token']); //ocekujemo da odgovor sadrzi i token
});

//Test za prijavu sa pogresnom lozinkom
test('prijava sa pogresnom lozinkom nije moguca', function () {
    User::factory()->create([ 
        'email' => 'test@test.com',
        'password' => bcrypt('password123'),
    ]);

    $response = postJson('/api/login', [
        'email' => 'test@test.com',
        'password' => 'pogresna_lozinka',
    ]);

    $response->assertStatus(401); //ocekujemo status 401, jer je lozinka pogresna i prijava nije moguca
});

//Test za odjavu korisnika
test('prijavljen korisnik se moze odjaviti', function () {
    $user = User::factory()->create();  //kreiramo korisnika u bazi
    $token = $user->createToken('api_token')->plainTextToken;

    $response = postJson('/api/logout', [], [   //saljemo zahtev na /api/logout da vidimo da li se korisnik moze odjaviti
        'Authorization' => 'Bearer ' . $token,  //dodajemo token u header zahteva, da bismo mogli testirati odjavu
    ]);

    $response->assertStatus(200);   //ocekujemo status 200, jer je korisnik uspesno odjavljen
});

//Test za registraciju bez obaveznih polja
test('registracija nije moguca bez obaveznih polja', function () {
    $response = postJson('/api/register', [ //saljemo zahtev na /api/register bez obaveznih polja, da vidimo da li je registracija moguca
        'email' => 'ana@test.com',
    ]);

    $response->assertStatus(422);   //ocekujemo status 422, jer obavezna polja nisu popunjena i registracija nije moguca
});