<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\postJson;
use function Pest\Laravel\getJson;

uses(RefreshDatabase::class); //pre svakog testa ocistimo bazu, da ne bi uticali jedni na druge

//Test za prikaz svih restorana
test('svi korisnici mogu videti listu restorana', function () {
    $response = getJson('/api/restorani');  //saljemo zahtev na /api/restorani da vidimo da li svi korisnici mogu videti listu restorana
    $response->assertStatus(200);   //ocekujemo status 200, jer svi korisnici mogu videti listu restorana
});

//Test za prikaz jednog restorana
test('svi korisnici mogu videti jedan restoran', function () {
    $response = getJson('/api/restorani/1');    //saljemo zahtev na /api/restorani/1 da vidimo da li svi korisnici mogu videti jedan restoran
    $response->assertStatus(200);   //ocekujemo status 200, jer svi korisnici mogu videti jedan restoran
});

//Test za dodavanje restorana
test('admin moze dodati restoran', function () {
    $admin = User::factory()->create(['role' => 'admin']);  //kreiramo admina u bazi
    $token = $admin->createToken('api_token')->plainTextToken;  //kreiramo token za admina, da bismo mogli testirati dodavanje restorana kao admin

    $response = postJson('/api/restorani', [    //saljemo zahtev na /api/restorani da vidimo da li admin moze dodati restoran
        'naziv' => 'Test Restoran',
        'lokacija' => 'Beograd',
        'image_url' => 'https://test.com/slika.jpg',
        'aktivan' => true,
    ], [
        'Authorization' => 'Bearer ' . $token,  //dodajemo token u header zahteva, da bismo mogli testirati dodavanje restorana kao admin
    ]);

    $response->assertStatus(201);   //ocekujemo status 201, jer je restoran uspesno dodat
});

//Test za dodavanje restorana bez autorizacije
test('neautorizovan korisnik ne moze dodati restoran', function () {
    $response = postJson('/api/restorani', [
        'naziv' => 'Test Restoran',
        'lokacija' => 'Beograd',
    ]);

    $response->assertStatus(401);
});

//Test za dodavanje restorana kao kupac
test('kupac ne moze dodati restoran', function () {
    $kupac = User::factory()->create(['role' => 'kupac']);
    $token = $kupac->createToken('api_token')->plainTextToken;

    $response = postJson('/api/restorani', [
        'naziv' => 'Test Restoran',
        'lokacija' => 'Beograd',
    ], [
        'Authorization' => 'Bearer ' . $token,
    ]);

    $response->assertStatus(403);
});