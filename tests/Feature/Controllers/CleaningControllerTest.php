<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Cleaning;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CleaningControllerTest extends TestCase
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
    public function it_displays_index_view_with_cleanings()
    {
        $cleanings = Cleaning::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('cleanings.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.cleanings.index')
            ->assertViewHas('cleanings');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_cleaning()
    {
        $response = $this->get(route('cleanings.create'));

        $response->assertOk()->assertViewIs('app.cleanings.create');
    }

    /**
     * @test
     */
    public function it_stores_the_cleaning()
    {
        $data = Cleaning::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('cleanings.store'), $data);

        $this->assertDatabaseHas('cleanings', $data);

        $cleaning = Cleaning::latest('id')->first();

        $response->assertRedirect(route('cleanings.edit', $cleaning));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_cleaning()
    {
        $cleaning = Cleaning::factory()->create();

        $response = $this->get(route('cleanings.show', $cleaning));

        $response
            ->assertOk()
            ->assertViewIs('app.cleanings.show')
            ->assertViewHas('cleaning');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_cleaning()
    {
        $cleaning = Cleaning::factory()->create();

        $response = $this->get(route('cleanings.edit', $cleaning));

        $response
            ->assertOk()
            ->assertViewIs('app.cleanings.edit')
            ->assertViewHas('cleaning');
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

        $response = $this->put(route('cleanings.update', $cleaning), $data);

        $data['id'] = $cleaning->id;

        $this->assertDatabaseHas('cleanings', $data);

        $response->assertRedirect(route('cleanings.edit', $cleaning));
    }

    /**
     * @test
     */
    public function it_deletes_the_cleaning()
    {
        $cleaning = Cleaning::factory()->create();

        $response = $this->delete(route('cleanings.destroy', $cleaning));

        $response->assertRedirect(route('cleanings.index'));

        $this->assertDeleted($cleaning);
    }
}
