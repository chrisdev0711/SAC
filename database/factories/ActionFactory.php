<?php

namespace Database\Factories;

use App\Models\Action;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Action::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'appliance_id' => \App\Models\Appliance::factory(),
            'actioned_by' => \App\Models\User::factory(),
            'actionable_type' => $this->faker->randomElement([
                \App\Models\CheckIn::class,
                \App\Models\PlugCheck::class,
                \App\Models\FaultDiagnosis::class,
                \App\Models\Cleaning::class,
                \App\Models\QualityControl::class,
            ]),
            'actionable_id' => function (array $item) {
                return app($item['actionable_type'])->factory();
            },
        ];
    }
}
