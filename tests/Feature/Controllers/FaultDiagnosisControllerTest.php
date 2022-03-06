<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\FaultDiagnosis;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FaultDiagnosisControllerTest extends TestCase
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
    public function it_displays_index_view_with_fault_diagnoses()
    {
        $faultDiagnoses = FaultDiagnosis::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('fault-diagnoses.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.fault_diagnoses.index')
            ->assertViewHas('faultDiagnoses');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_fault_diagnosis()
    {
        $response = $this->get(route('fault-diagnoses.create'));

        $response->assertOk()->assertViewIs('app.fault_diagnoses.create');
    }

    /**
     * @test
     */
    public function it_stores_the_fault_diagnosis()
    {
        $data = FaultDiagnosis::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('fault-diagnoses.store'), $data);

        $this->assertDatabaseHas('fault_diagnoses', $data);

        $faultDiagnosis = FaultDiagnosis::latest('id')->first();

        $response->assertRedirect(
            route('fault-diagnoses.edit', $faultDiagnosis)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_fault_diagnosis()
    {
        $faultDiagnosis = FaultDiagnosis::factory()->create();

        $response = $this->get(route('fault-diagnoses.show', $faultDiagnosis));

        $response
            ->assertOk()
            ->assertViewIs('app.fault_diagnoses.show')
            ->assertViewHas('faultDiagnosis');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_fault_diagnosis()
    {
        $faultDiagnosis = FaultDiagnosis::factory()->create();

        $response = $this->get(route('fault-diagnoses.edit', $faultDiagnosis));

        $response
            ->assertOk()
            ->assertViewIs('app.fault_diagnoses.edit')
            ->assertViewHas('faultDiagnosis');
    }

    /**
     * @test
     */
    public function it_updates_the_fault_diagnosis()
    {
        $faultDiagnosis = FaultDiagnosis::factory()->create();

        $data = [
            'time_started' => $this->faker->time,
            'time_finished' => $this->faker->time,
            'fault_found' => $this->faker->sentence(15),
            'parts_required' => $this->faker->text,
            'repaired' => $this->faker->boolean,
            'test_again' => $this->faker->boolean,
        ];

        $response = $this->put(
            route('fault-diagnoses.update', $faultDiagnosis),
            $data
        );

        $data['id'] = $faultDiagnosis->id;

        $this->assertDatabaseHas('fault_diagnoses', $data);

        $response->assertRedirect(
            route('fault-diagnoses.edit', $faultDiagnosis)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_fault_diagnosis()
    {
        $faultDiagnosis = FaultDiagnosis::factory()->create();

        $response = $this->delete(
            route('fault-diagnoses.destroy', $faultDiagnosis)
        );

        $response->assertRedirect(route('fault-diagnoses.index'));

        $this->assertDeleted($faultDiagnosis);
    }
}
