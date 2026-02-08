<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Flight;

class FlightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //normal way
        // for($i=0;$i<20;$i++){

        //     // DB::table('flights')->insert([
        //     //     'name' => Str::random(10)
        //     // ]);
        //     Flight::create([
        //         'name' => Str::random(10)
        //     ]);
        // }
        //using factory way
        Flight::factory(20)->create();
    }
}
