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
        User::factory(5)->create();
        Dostavljac::factory(5)->create();
        Restoran::factory(5)->create();
        Jelo::factory(20)->create();
        Porudzbina::factory(8)->create();  
        StavkaPorudzbine::factory(10)->create();
        Recenzija::factory(5)->create();
    }
}
