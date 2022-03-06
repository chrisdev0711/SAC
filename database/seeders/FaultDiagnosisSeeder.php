<?php

namespace Database\Seeders;

use App\Models\FaultDiagnosis;
use Illuminate\Database\Seeder;

class FaultDiagnosisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FaultDiagnosis::factory()
            ->count(5)
            ->create();
    }
}
