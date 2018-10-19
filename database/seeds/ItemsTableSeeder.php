<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('items')->truncate();

        $faker = Faker::create();

        foreach (range(1,100)as $i){
            DB::table('items')->insert(
                ['name' => $faker->name(),
                    'imagem' => $faker->imageUrl($width = 640, $height = 480, 'cats', true, 'Faker'),
                    'num_rifias' => $faker->numberBetween($min = 20, $max = 300),
                    'valor_rifa' => $faker->numberBetween($min = 1, $max = 10),
                    'valor_venda' => $faker->numberBetween($min = 1, $max = 10),
                    'valor_rp' => $faker->numberBetween($min = 1, $max = 10),
                    'resgatavel' => $faker->boolean,
                    'status' => $faker->boolean,
                    'tipo_items_id' => $faker->numberBetween($min = 1, $max = 4),

                ]);
        }
    }
}
