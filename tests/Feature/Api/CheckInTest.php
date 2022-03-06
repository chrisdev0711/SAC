<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\CheckIn;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CheckInTest extends TestCase
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
    public function it_gets_check_ins_list()
    {
        $checkIns = CheckIn::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.check-ins.index'));

        $response->assertOk()->assertSee($checkIns[0]->appliance_in_img);
    }

    /**
     * @test
     */
    public function it_stores_the_check_in()
    {
        $data = CheckIn::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.check-ins.store'), $data);

        $this->assertDatabaseHas('check_ins', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_check_in()
    {
        $checkIn = CheckIn::factory()->create();

        $data = [
            'data_badge_img' => $this->faker->text(255),
            'serial_num' => $this->faker->text(255),
        ];

        $response = $this->putJson(
            route('api.check-ins.update', $checkIn),
            $data
        );

        $data['id'] = $checkIn->id;

        $this->assertDatabaseHas('check_ins', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_check_in()
    {
        $checkIn = CheckIn::factory()->create();

        $response = $this->deleteJson(route('api.check-ins.destroy', $checkIn));

        $this->assertDeleted($checkIn);

        $response->assertNoContent();
    }
}
