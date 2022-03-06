<?php

namespace Database\Seeders;

use App\Models\PlugCheck;
use Illuminate\Database\Seeder;

class PlugCheckSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PlugCheck::factory()
            ->count(5)
            ->create();
    }
}
