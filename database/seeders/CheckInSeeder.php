<?php

namespace Database\Seeders;

use App\Models\CheckIn;
use Illuminate\Database\Seeder;

class CheckInSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CheckIn::factory()
            ->count(5)
            ->create();
    }
}
