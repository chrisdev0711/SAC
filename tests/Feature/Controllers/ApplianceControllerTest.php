<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Appliance;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApplianceControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_appliances()
    {
        $appliances = Appliance::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('appliances.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.appliances.index')
            ->assertViewHas('appliances');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_appliance()
    {
        $response = $this->get(route('appliances.create'));

        $response->assertOk()->assertViewIs('app.appliances.create');
    }

    /**
     * @test
     */
    public function it_stores_the_appliance()
    {
        $data = Appliance::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('appliances.store'), $data);

        unset($data['Grade']);

        $this->assertDatabaseHas('appliances', $data);

        $appliance = Appliance::latest('id')->first();

        $response->assertRedirect(route('appliances.edit', $appliance));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_appliance()
    {
        $appliance = Appliance::factory()->create();

        $response = $this->get(route('appliances.show', $appliance));

        $response
            ->assertOk()
            ->assertViewIs('app.appliances.show')
            ->assertViewHas('appliance');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_appliance()
    {
        $appliance = Appliance::factory()->create();

        $response = $this->get(route('appliances.edit', $appliance));

        $response
            ->assertOk()
            ->assertViewIs('app.appliances.edit')
            ->assertViewHas('appliance');
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

        $response = $this->put(route('appliances.update', $appliance), $data);

        unset($data['Grade']);

        $data['id'] = $appliance->id;

        $this->assertDatabaseHas('appliances', $data);

        $response->assertRedirect(route('appliances.edit', $appliance));
    }

    /**
     * @test
     */
    public function it_deletes_the_appliance()
    {
        $appliance = Appliance::factory()->create();

        $response = $this->delete(route('appliances.destroy', $appliance));

        $response->assertRedirect(route('appliances.index'));

        $this->assertDeleted($appliance);
    }
}
