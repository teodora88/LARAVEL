<?php

namespace Database\Seeders;

use App\Models\Brend;
use Illuminate\Database\Seeder;

class BrendTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Brend::create([
            'brend' => 'A'
        ]);

        Brend::create([
            'brend' => 'B'
        ]);

        Brend::create([
            'brend' => 'C'
        ]);

    }
}
