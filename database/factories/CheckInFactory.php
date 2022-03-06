<?php

namespace Database\Factories;

use App\Models\CheckIn;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class CheckInFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CheckIn::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'serial_num' => $this->faker->numerify('SN#######'),
            'condition' => 'lightly used',
        ];
    }
}
