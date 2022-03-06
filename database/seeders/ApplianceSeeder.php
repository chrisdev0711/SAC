<?php

namespace Database\Seeders;

use App\Models\Appliance;
use Illuminate\Database\Seeder;

class ApplianceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Appliance::factory()
            ->count(5)
            ->create();
    }
}
