<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\QualityControl;
use Illuminate\Database\Eloquent\Factories\Factory;

class QualityControlFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = QualityControl::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'condition' => 'grade a',
            'parts_burners' => 'not required',
            'parts_pan_supports' => 'not required',
            'parts_grill_tray' => 'not required',
            'parts_oven_shelves' => 'not required',
            'parts_oven_rails' => 'not required',
            'parts_door_glass' => 'not required',
            'parts_fridge_shelves' => 'not required',
            'cosmetic_marks' => $this->faker->text,
        ];
    }
}
