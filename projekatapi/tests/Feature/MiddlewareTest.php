<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\postJson;
use function Pest\Laravel\getJson;

uses(RefreshDatabase::class); //pre svakog testa ocistimo bazu, da ne bi uticali jedni na druge

//Test za pristup zasticenoj ruti bez autorizacije
test('neautorizovan korisnik ne moze pristupiti zasticenoj ruti', function () {
    $response = postJson('/api/logout');    //saljemo zahtev na /api/logout bez tokena, da vidimo da li neautorizovan korisnik moze pristupiti zasticenoj ruti
    $response->assertStatus(401);   //ocekujemo status 401, jer neautorizovan korisnik ne moze pristupiti zasticenoj ruti
});

//Test za pristup admin ruti kao kupac
test('kupac ne moze pristupiti admin ruti', function () {
    $kupac = User::factory()->create(['role' => 'kupac']);  //kreiramo kupca u bazi
    $token = $kupac->createToken('api_token')->plainTextToken; //kreiramo token za kupca, da bismo mogli testirati pristup admin ruti

    $response = getJson('/api/porudzbine', [    //saljemo zahtev na /api/porudzbine kao kupac
        'Authorization' => 'Bearer ' . $token,  //dodajemo token u header zahteva, da bismo mogli testirati pristup admin ruti
    ]);

    $response->assertStatus(403);   //ocekujemo status 403, jer kupac ne moze pristupiti admin ruti
});

//Test za pristup admin ruti kao dostavljac
test('dostavljac ne moze pristupiti admin ruti', function () {
    $dostavljac = User::factory()->create(['role' => 'dostavljac']);
    $token = $dostavljac->createToken('api_token')->plainTextToken;

    $response = getJson('/api/porudzbine', [
        'Authorization' => 'Bearer ' . $token,
    ]);

    $response->assertStatus(403);
});

//Test za pristup admin ruti kao admin
test('admin moze pristupiti admin ruti', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $token = $admin->createToken('api_token')->plainTextToken;

    $response = getJson('/api/porudzbine', [
        'Authorization' => 'Bearer ' . $token,
    ]);

    $response->assertStatus(200);
});