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
            'brend' => 'Vichy'
        ]);

        Brend::create([
            'brend' => 'The Ordinary'
        ]);

        Brend::create([
            'brend' => 'CeraVe'
        ]);

        Brend::create([
            'brend' => 'Biotherm'
        ]);

        Brend::create([
            'brend' => 'Eucerin'
        ]);

        Brend::create([
            'brend' => 'NEOGEN'
        ]);

    }
}
