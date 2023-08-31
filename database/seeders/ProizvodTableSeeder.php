<?php

namespace Database\Seeders;

use App\Models\Proizvod;
use Illuminate\Database\Seeder;

class ProizvodTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 30; $i++) {

            Proizvod::create([
                'naziv' => ucfirst($faker->word()),
                'brendID' => rand(1,6),
                'tipID' => rand(1,3), 
                'cena' => $faker->numberBetween(550, 5550)
            ]);
        }
    }
}
