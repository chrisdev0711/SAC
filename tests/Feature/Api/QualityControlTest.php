<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\QualityControl;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class QualityControlTest extends TestCase
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
    public function it_gets_quality_controls_list()
    {
        $qualityControls = QualityControl::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.quality-controls.index'));

        $response
            ->assertOk()
            ->assertSee($qualityControls[0]->cosmetic_mark1_img);
    }

    /**
     * @test
     */
    public function it_stores_the_quality_control()
    {
        $data = QualityControl::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.quality-controls.store'), $data);

        unset($data['cosmetic_mark4_img']);
        unset($data['cosmetic_mark5_img']);
        unset($data['cosmetic_mark6_img']);

        $this->assertDatabaseHas('quality_controls', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.quality-controls.update', $qualityControl),
            $data
        );

        unset($data['cosmetic_mark4_img']);
        unset($data['cosmetic_mark5_img']);
        unset($data['cosmetic_mark6_img']);

        $data['id'] = $qualityControl->id;

        $this->assertDatabaseHas('quality_controls', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_quality_control()
    {
        $qualityControl = QualityControl::factory()->create();

        $response = $this->deleteJson(
            route('api.quality-controls.destroy', $qualityControl)
        );

        $this->assertDeleted($qualityControl);

        $response->assertNoContent();
    }
}
