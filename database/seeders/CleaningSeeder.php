<?php

namespace Database\Seeders;

use App\Models\Cleaning;
use Illuminate\Database\Seeder;

class CleaningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cleaning::factory()
            ->count(5)
            ->create();
    }
}
