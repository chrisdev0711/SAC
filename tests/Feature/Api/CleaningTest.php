<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Cleaning;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CleaningTest extends TestCase
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
    public function it_gets_cleanings_list()
    {
        $cleanings = Cleaning::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.cleanings.index'));

        $response->assertOk()->assertSee($cleanings[0]->inside_before_img);
    }

    /**
     * @test
     */
    public function it_stores_the_cleaning()
    {
        $data = Cleaning::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.cleanings.store'), $data);

        $this->assertDatabaseHas('cleanings', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_cleaning()
    {
        $cleaning = Cleaning::factory()->create();

        $data = [
            'time_started' => $this->faker->time,
            'time_finished' => $this->faker->time,
            'inside_before_img' => $this->faker->text(255),
            'outside_before_img' => $this->faker->text(255),
            'inside_after_img' => $this->faker->text(255),
            'outside_after_img' => $this->faker->text(255),
        ];

        $response = $this->putJson(
            route('api.cleanings.update', $cleaning),
            $data
        );

        $data['id'] = $cleaning->id;

        $this->assertDatabaseHas('cleanings', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_cleaning()
    {
        $cleaning = Cleaning::factory()->create();

        $response = $this->deleteJson(
            route('api.cleanings.destroy', $cleaning)
        );

        $this->assertDeleted($cleaning);

        $response->assertNoContent();
    }
}
