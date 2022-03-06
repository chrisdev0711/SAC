<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\CheckIn;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CheckInControllerTest extends TestCase
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
    public function it_displays_index_view_with_check_ins()
    {
        $checkIns = CheckIn::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('check-ins.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.check_ins.index')
            ->assertViewHas('checkIns');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_check_in()
    {
        $response = $this->get(route('check-ins.create'));

        $response->assertOk()->assertViewIs('app.check_ins.create');
    }

    /**
     * @test
     */
    public function it_stores_the_check_in()
    {
        $data = CheckIn::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('check-ins.store'), $data);

        $this->assertDatabaseHas('check_ins', $data);

        $checkIn = CheckIn::latest('id')->first();

        $response->assertRedirect(route('check-ins.edit', $checkIn));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_check_in()
    {
        $checkIn = CheckIn::factory()->create();

        $response = $this->get(route('check-ins.show', $checkIn));

        $response
            ->assertOk()
            ->assertViewIs('app.check_ins.show')
            ->assertViewHas('checkIn');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_check_in()
    {
        $checkIn = CheckIn::factory()->create();

        $response = $this->get(route('check-ins.edit', $checkIn));

        $response
            ->assertOk()
            ->assertViewIs('app.check_ins.edit')
            ->assertViewHas('checkIn');
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

        $response = $this->put(route('check-ins.update', $checkIn), $data);

        $data['id'] = $checkIn->id;

        $this->assertDatabaseHas('check_ins', $data);

        $response->assertRedirect(route('check-ins.edit', $checkIn));
    }

    /**
     * @test
     */
    public function it_deletes_the_check_in()
    {
        $checkIn = CheckIn::factory()->create();

        $response = $this->delete(route('check-ins.destroy', $checkIn));

        $response->assertRedirect(route('check-ins.index'));

        $this->assertDeleted($checkIn);
    }
}
