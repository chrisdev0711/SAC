<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\QualityControl;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class QualityControlControllerTest extends TestCase
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
    public function it_displays_index_view_with_quality_controls()
    {
        $qualityControls = QualityControl::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('quality-controls.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.quality_controls.index')
            ->assertViewHas('qualityControls');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_quality_control()
    {
        $response = $this->get(route('quality-controls.create'));

        $response->assertOk()->assertViewIs('app.quality_controls.create');
    }

    /**
     * @test
     */
    public function it_stores_the_quality_control()
    {
        $data = QualityControl::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('quality-controls.store'), $data);

        unset($data['cosmetic_mark4_img']);
        unset($data['cosmetic_mark5_img']);
        unset($data['cosmetic_mark6_img']);

        $this->assertDatabaseHas('quality_controls', $data);

        $qualityControl = QualityControl::latest('id')->first();

        $response->assertRedirect(
            route('quality-controls.edit', $qualityControl)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_quality_control()
    {
        $qualityControl = QualityControl::factory()->create();

        $response = $this->get(route('quality-controls.show', $qualityControl));

        $response
            ->assertOk()
            ->assertViewIs('app.quality_controls.show')
            ->assertViewHas('qualityControl');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_quality_control()
    {
        $qualityControl = QualityControl::factory()->create();

        $response = $this->get(route('quality-controls.edit', $qualityControl));

        $response
            ->assertOk()
            ->assertViewIs('app.quality_controls.edit')
            ->assertViewHas('qualityControl');
    }

    /**
     * @test
     */
    public function it_updates_the_quality_control()
    {
        $qualityControl = QualityControl::factory()->create();

        $data = [
            'condition' => 'Grade A',
            'parts_burners' => 'N/A',
            'parts_ pan_supports' => 'N/A',
            'parts_grill_tray' => 'N/A',
            'parts_oven_shelves' => 'N/A',
            'parts_oven_rails' => 'N/A',
            'parts_door_glass' => 'N/A',
            'parts_fridge_shelves' => 'N/A',
            'cosmetic_marks' => 'Front',
            'cosmetic_mark1_img' => $this->faker->text(255),
            'cosmetic_mark2_img' => $this->faker->text(255),
            'cosmetic_mark3_img' => $this->faker->text(255),
            'cosmetic_mark4_img' => $this->faker->text(255),
            'cosmetic_mark5_img' => $this->faker->text(255),
            'cosmetic_mark6_img' => $this->faker->text(255),
        ];

        $response = $this->put(
            route('quality-controls.update', $qualityControl),
            $data
        );

        unset($data['cosmetic_mark4_img']);
        unset($data['cosmetic_mark5_img']);
        unset($data['cosmetic_mark6_img']);

        $data['id'] = $qualityControl->id;

        $this->assertDatabaseHas('quality_controls', $data);

        $response->assertRedirect(
            route('quality-controls.edit', $qualityControl)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_quality_control()
    {
        $qualityControl = QualityControl::factory()->create();

        $response = $this->delete(
            route('quality-controls.destroy', $qualityControl)
        );

        $response->assertRedirect(route('quality-controls.index'));

        $this->assertDeleted($qualityControl);
    }
}
