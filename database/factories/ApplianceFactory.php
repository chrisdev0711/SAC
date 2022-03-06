<?php

namespace Database\Factories;

use App\Models\Appliance;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApplianceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Appliance::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'SACNo' => $this->faker->numerify('544440###'),
            'Status' => 'pending',
            'ModelNumber' => $this->faker->numerify('MNEE###'),
            'Description' => $this->faker->sentence(3),
            'Supplier' => $this->faker->company,
            'purchase_date' => $this->faker->date,
            'CostExVat' => $this->faker->randomNumber(2),
            'VAT' => $this->faker->randomNumber(2),
            'CostIncVAT' => $this->faker->randomNumber(2),
            'PONumber' => $this->faker->numerify('SACPO###'),
            'OtherRef' => $this->faker->numerify('OTH###'),
            'SerialNum' => $this->faker->numerify('SN#######'),
        ];
    }
}
