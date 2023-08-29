<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       $this->call(BrendTableSeeder::class);

       $this->call(TipTableSeeder::class);
       
       $this->call(ProizvodTableSeeder::class);

       $this->call(UserTableSeeder::class);
    }
}
