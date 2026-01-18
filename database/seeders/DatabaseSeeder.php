<?php

namespace Database\Seeders;

use App\Models\Dostavljac;
use App\Models\Jelo;
use App\Models\Porudzbina;
use App\Models\Recenzija;
use App\Models\Restoran;
use App\Models\StavkaPorudzbine;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::statement("SET FOREIGN_KEY_CHECKS=0;"); //znaci ne proverava strane kljuceve tokom brisanja podataka

        StavkaPorudzbine::truncate();
        Recenzija::truncate();
        Jelo::truncate();
        Porudzbina::truncate();
        Restoran::truncate();
        Dostavljac::truncate();
        User::truncate();

        DB::statement("SET FOREIGN_KEY_CHECKS=1;");

        User::factory(10)->create();
        Restoran::factory(5)->create();
        Porudzbina::factory(20)->create();
        Dostavljac::factory(5)->create();
        Jelo::factory(50)->create();
        Recenzija::factory(30)->create();
        StavkaPorudzbine::factory(100)->create();
    }
}
