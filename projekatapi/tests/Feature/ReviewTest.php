<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\postJson;
use function Pest\Laravel\getJson;

uses(RefreshDatabase::class); //pre svakog testa ocistimo bazu, da ne bi uticali jedni na druge

//Testovi za prikaz recenzija
test('svi korisnici mogu videti recenzije', function () {
    $response = getJson('/api/recenzije');
    $response->assertStatus(200);
});

//Test za ostavljanje recenzije kao kupac
test('kupac moze ostaviti recenziju', function () {
    $kupac = User::factory()->create(['role' => 'kupac']);  //kreiramo kupca u bazi
    $token = $kupac->createToken('api_token')->plainTextToken;  //kreiramo token za kupca, da bismo mogli testirati ostavljanje recenzije kao kupac

    $restoran = \App\Models\Restoran::factory()->create();  //kreiramo restoran u bazi

    $response = postJson('/api/restorani/' . $restoran->id . '/recenzije', [    //saljemo zahtev na /api/restorani/{id}/recenzije da vidimo da li kupac moze ostaviti recenziju
        'ocena' => 5,
        'komentar' => 'Odlicna hrana!',
    ], [
        'Authorization' => 'Bearer ' . $token,
    ]);

    $response->assertStatus(201);   //ocekujemo status 201, jer je recenzija uspesno ostavljena
});

//Test za ostavljanje recenzije bez autorizacije
test('neautorizovan korisnik ne moze ostaviti recenziju', function () {
    $response = postJson('/api/recenzije', [
        'restoran_id' => 1,
        'ocena' => 5,
        'komentar' => 'Odlicna hrana!',
    ]);

    $response->assertStatus(401);
});

//Test za ostavljanje recenzije kao dostavljac
test('dostavljac ne moze ostaviti recenziju', function () {
    $dostavljac = User::factory()->create(['role' => 'dostavljac']);
    $token = $dostavljac->createToken('api_token')->plainTextToken;

    $response = postJson('/api/recenzije', [
        'restoran_id' => 1,
        'ocena' => 5,
        'komentar' => 'Odlicna hrana!',
    ], [
        'Authorization' => 'Bearer ' . $token,
    ]);

    $response->assertStatus(403);
});