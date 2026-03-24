<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\postJson;
use function Pest\Laravel\getJson;

uses(RefreshDatabase::class); //pre svakog testa ocistimo bazu, da ne bi uticali jedni na druge

//Test za kreiranje porudzbine kao kupac
test('kupac moze kreirati porudzbinu', function () {
    $kupac = User::factory()->create(['role' => 'kupac']);  //kreiramo kupca u bazi
    $token = $kupac->createToken('api_token')->plainTextToken;  //kreiramo token za kupca, da bismo mogli testirati kreiranje porudzbine
    
    $jelo = \App\Models\Jelo::factory()->create();  //kreiramo jelo u bazi, da bismo mogli testirati kreiranje porudzbine sa proizvodom

    $response = postJson('/api/porudzbine', [   //saljemo zahtev na /api/porudzbine da vidimo da li kupac moze kreirati porudzbinu
        'adresa_isporuke' => 'Knez Mihailova 5, Beograd',
        'nacin_placanja' => 'gotovina',
        'restoran_id' => $jelo->restoran_id,
        'proizvodi' => [
            ['id' => $jelo->id, 'kolicina' => 2],
        ],
    ], [
        'Authorization' => 'Bearer ' . $token,
    ]);

    $response->assertStatus(201);   //ocekujemo status 201, jer je porudzbina uspesno kreirana
});

//Test za kreiranje porudzbine bez autorizacije
test('neautorizovan korisnik ne moze kreirati porudzbinu', function () {
    $response = postJson('/api/porudzbine', [
        'adresa_isporuke' => 'Knez Mihailova 5, Beograd',
        'nacin_placanja' => 'gotovina',
    ]);

    $response->assertStatus(401);
});

//Test za proveru da admin moze videti sve porudzbine
test('admin moze videti sve porudzbine', function () {
    $admin = User::factory()->create(['role' => 'admin']);  //kreiramo admina u bazi
    $token = $admin->createToken('api_token')->plainTextToken;  //kreiramo token za admina, da bismo mogli testirati prikaz svih porudzbina

    $response = getJson('/api/porudzbine', [    //saljemo zahtev na /api/porudzbine kao admin
        'Authorization' => 'Bearer ' . $token,  //dodajemo token u header zahteva, da bismo mogli testirati prikaz svih porudzbina
    ]);

    $response->assertStatus(200);   //ocekujemo status 200, jer admin moze videti sve porudzbine
});

//Test za proveru da kupac ne moze videti sve porudzbine
test('kupac ne moze videti sve porudzbine', function () {
    $kupac = User::factory()->create(['role' => 'kupac']);  //kreiramo kupca u bazi
    $token = $kupac->createToken('api_token')->plainTextToken;  

    $response = getJson('/api/porudzbine', [       //saljemo zahtev na /api/porudzbine kao kupac
        'Authorization' => 'Bearer ' . $token,  //dodajemo token u header zahteva, da bismo mogli testirati prikaz svih porudzbina
    ]);

    $response->assertStatus(403);   //ocekujemo status 403, jer kupac ne moze videti sve porudzbine
});