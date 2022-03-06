<?php

namespace Database\Factories;

use App\Models\PlugCheck;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlugCheckFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PlugCheck::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'pass_test' => $this->faker->boolean,
            'repair_type' => 'not required',
        ];
    }
}
