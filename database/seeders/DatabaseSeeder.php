<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Dostavljac;
use App\Models\Restoran;
use App\Models\Jelo;
use App\Models\Porudzbina;
use App\Models\StavkaPorudzbine;
use App\Models\Recenzija;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;'); //ovo omogućava brisanje podataka iz tabela koje imaju spoljne ključeve

        //ovo brise sve podatke iz tabela pre ponovnog seeding-a
        //moze se koristiti php artisan migrate:fresh --seed, koji brise sve tabele i ponovo ih kreira sa seeding-om
        
        Jelo::truncate();
        Porudzbina::truncate();
        StavkaPorudzbine::truncate();
        Recenzija::truncate();
        Restoran::truncate();
        Dostavljac::truncate();
        User::truncate();

        //ovo ponovo popunjava tabele sa podacima
        User::factory(5)->create();
        Dostavljac::factory(5)->create();
        Restoran::factory(5)->create();
        Jelo::factory(20)->create();
        Porudzbina::factory(8)->create();  
        StavkaPorudzbine::factory(10)->create();
        Recenzija::factory(5)->create();
    }
}
