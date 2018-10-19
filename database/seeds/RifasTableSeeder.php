<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class RifasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('rifas')->truncate();
        $faker = Faker::create();

        foreach (range(1,3)as $i){

            DB::table('rifas')->insert(
                ['name' => $faker->name(),
                    'ordem' => $i,
                    'date_inicio' => $faker->date($format = 'Y-m-d', $max = 'now'),
                    'date_fim' => $faker->date($format = 'Y-m-d', $max = 'now'),
                ]);
        }


    }
}
