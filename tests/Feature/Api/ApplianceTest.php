<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Appliance;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApplianceTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_appliances_list()
    {
        $appliances = Appliance::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.appliances.index'));

        $response->assertOk()->assertSee($appliances[0]->ModelNumber);
    }

    /**
     * @test
     */
    public function it_stores_the_appliance()
    {
        $data = Appliance::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.appliances.store'), $data);

        unset($data['Grade']);

        $this->assertDatabaseHas('appliances', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_appliance()
    {
        $appliance = Appliance::factory()->create();

        $data = [
            'SACNo' => $this->faker->word,
            'Location' => 'Pending',
            'ModelNumber' => $this->faker->text(255),
            'Description' => $this->faker->sentence(15),
            'Supplier' => $this->faker->text,
            'Purchase Date' => $this->faker->date,
            'CostExVat' => $this->faker->randomNumber(2),
            'VAT' => $this->faker->randomNumber(2),
            'CostIncVAT' => $this->faker->randomNumber(2),
            'PONumber' => $this->faker->text(255),
            'OtherRef' => $this->faker->text(255),
            'SerialNum' => $this->faker->text(255),
        ];

        $response = $this->putJson(
            route('api.appliances.update', $appliance),
            $data
        );

        unset($data['Grade']);

        $data['id'] = $appliance->id;

        $this->assertDatabaseHas('appliances', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_appliance()
    {
        $appliance = Appliance::factory()->create();

        $response = $this->deleteJson(
            route('api.appliances.destroy', $appliance)
        );

        $this->assertDeleted($appliance);

        $response->assertNoContent();
    }
}
