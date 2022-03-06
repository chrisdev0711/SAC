<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\FaultDiagnosis;
use Illuminate\Database\Eloquent\Factories\Factory;

class FaultDiagnosisFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FaultDiagnosis::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'time_started' => $this->faker->dateTime,
            'time_finished' => $this->faker->dateTime,
            'fault_found' => $this->faker->text,
            'parts_required' => $this->faker->text,
            'repaired' => $this->faker->boolean,
            'test_again' => $this->faker->boolean,
        ];
    }
}
