<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\PlugCheck;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PlugCheckTest extends TestCase
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
    public function it_gets_plug_checks_list()
    {
        $plugChecks = PlugCheck::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.plug-checks.index'));

        $response->assertOk()->assertSee($plugChecks[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_plug_check()
    {
        $data = PlugCheck::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.plug-checks.store'), $data);

        $this->assertDatabaseHas('plug_checks', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_plug_check()
    {
        $plugCheck = PlugCheck::factory()->create();

        $data = [
            'pass_test' => $this->faker->boolean,
            'repair_type' => 'N/A',
        ];

        $response = $this->putJson(
            route('api.plug-checks.update', $plugCheck),
            $data
        );

        $data['id'] = $plugCheck->id;

        $this->assertDatabaseHas('plug_checks', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_plug_check()
    {
        $plugCheck = PlugCheck::factory()->create();

        $response = $this->deleteJson(
            route('api.plug-checks.destroy', $plugCheck)
        );

        $this->assertDeleted($plugCheck);

        $response->assertNoContent();
    }
}
