<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Action;
use App\Models\Appliance;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApplianceActionsTest extends TestCase
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
    public function it_gets_appliance_actions()
    {
        $appliance = Appliance::factory()->create();
        $actions = Action::factory()
            ->count(2)
            ->create([
                'appliance_id' => $appliance->id,
            ]);

        $response = $this->getJson(
            route('api.appliances.actions.index', $appliance)
        );

        $response->assertOk()->assertSee($actions[0]->actionable_type);
    }

    /**
     * @test
     */
    public function it_stores_the_appliance_actions()
    {
        $appliance = Appliance::factory()->create();
        $data = Action::factory()
            ->make([
                'appliance_id' => $appliance->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.appliances.actions.store', $appliance),
            $data
        );

        unset($data['actionable_id']);
        unset($data['actionable_type']);
        unset($data['appliance_id']);
        unset($data['user_id']);

        $this->assertDatabaseHas('actions', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $action = Action::latest('id')->first();

        $this->assertEquals($appliance->id, $action->appliance_id);
    }
}
