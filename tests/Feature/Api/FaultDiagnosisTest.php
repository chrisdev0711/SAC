<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\FaultDiagnosis;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FaultDiagnosisTest extends TestCase
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
    public function it_gets_fault_diagnoses_list()
    {
        $faultDiagnoses = FaultDiagnosis::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.fault-diagnoses.index'));

        $response->assertOk()->assertSee($faultDiagnoses[0]->fault_found);
    }

    /**
     * @test
     */
    public function it_stores_the_fault_diagnosis()
    {
        $data = FaultDiagnosis::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.fault-diagnoses.store'), $data);

        $this->assertDatabaseHas('fault_diagnoses', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.fault-diagnoses.update', $faultDiagnosis),
            $data
        );

        $data['id'] = $faultDiagnosis->id;

        $this->assertDatabaseHas('fault_diagnoses', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_fault_diagnosis()
    {
        $faultDiagnosis = FaultDiagnosis::factory()->create();

        $response = $this->deleteJson(
            route('api.fault-diagnoses.destroy', $faultDiagnosis)
        );

        $this->assertDeleted($faultDiagnosis);

        $response->assertNoContent();
    }
}
