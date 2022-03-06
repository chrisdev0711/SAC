<?php

namespace Database\Factories;

use App\Models\Cleaning;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class CleaningFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cleaning::class;

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
        ];
    }
}
