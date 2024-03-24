<?php

namespace Tests\Feature\Livewire\Patients;

use App\Livewire\Patients;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class PatientsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function renders_successfully()
    {
        $this->withoutExceptionHandling();
        Livewire::actingAs(User::factory()->create());

        $this->get('/patients')
            ->assertStatus(200);
    }

    /** @test  */
    public function test_can_create_patient()
    {
        $patient = Patient::factory()->make([
            'name' => 'Ec Maranan',
            'firstName' => 'Ec',
            'lastName' => 'Maranan',
            'contactNumber' => '675575486',
        ]);

        Livewire::test(Patients::class)
            ->set([
                'name' => $patient['name'],
                'firstName' => $patient['firstName'],
                'lastName' => $patient['lastName'],
                'contactNumber' => $patient['contactNumber'],
                'address' => null,
                'email' => null,
            ])
            ->call('save')
            ->assertRedirect();
    }

    /** @test  */
    public function test_can_update_patient()
    {
        Livewire::test(Patients::class)
            ->set('selectedFirstName', 'Ec')
            ->set('selectedLastName', 'Maranan')
            ->set('selectedContactNumber', '360520861')
            ->set('selectedAddress', null)
            ->set('selectedEmail', null)
            ->call('update', 1)
            ->assertRedirect();
    }

    /** @test */
    public function test_can_delete_patient()
    {
        $patient = Patient::factory()->create([
            'name' => 'Ec Maranan',
            'first_name' => 'Ec',
            'last_name' => 'Maranan',
            'contact_number' => '675575486',
        ]);

        Livewire::test(Patients::class)
            ->set('selectedId', 1)
            ->set('patient', $patient)
            ->call('delete')
            ->assertRedirect();
    }
}
