<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\PlugCheck;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PlugCheckControllerTest extends TestCase
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
    public function it_displays_index_view_with_plug_checks()
    {
        $plugChecks = PlugCheck::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('plug-checks.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.plug_checks.index')
            ->assertViewHas('plugChecks');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_plug_check()
    {
        $response = $this->get(route('plug-checks.create'));

        $response->assertOk()->assertViewIs('app.plug_checks.create');
    }

    /**
     * @test
     */
    public function it_stores_the_plug_check()
    {
        $data = PlugCheck::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('plug-checks.store'), $data);

        $this->assertDatabaseHas('plug_checks', $data);

        $plugCheck = PlugCheck::latest('id')->first();

        $response->assertRedirect(route('plug-checks.edit', $plugCheck));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_plug_check()
    {
        $plugCheck = PlugCheck::factory()->create();

        $response = $this->get(route('plug-checks.show', $plugCheck));

        $response
            ->assertOk()
            ->assertViewIs('app.plug_checks.show')
            ->assertViewHas('plugCheck');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_plug_check()
    {
        $plugCheck = PlugCheck::factory()->create();

        $response = $this->get(route('plug-checks.edit', $plugCheck));

        $response
            ->assertOk()
            ->assertViewIs('app.plug_checks.edit')
            ->assertViewHas('plugCheck');
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

        $response = $this->put(route('plug-checks.update', $plugCheck), $data);

        $data['id'] = $plugCheck->id;

        $this->assertDatabaseHas('plug_checks', $data);

        $response->assertRedirect(route('plug-checks.edit', $plugCheck));
    }

    /**
     * @test
     */
    public function it_deletes_the_plug_check()
    {
        $plugCheck = PlugCheck::factory()->create();

        $response = $this->delete(route('plug-checks.destroy', $plugCheck));

        $response->assertRedirect(route('plug-checks.index'));

        $this->assertDeleted($plugCheck);
    }
}
