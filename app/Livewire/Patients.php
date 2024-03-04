<?php

namespace App\Livewire;

use App\Models\Patient;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;

class Patients extends Component
{
    use WithPagination;

    #[Validate]
    public $firstName = '';
    #[Validate]
    public $lastName = '';
    #[Validate]
    public $contactNumber;

    #[Validate]
    public $selectedFirstName;
    #[Validate]
    public $selectedLastName;
    #[Validate]
    public $selectedContactNumber;
    public $selectedId;

    public $search = '';

    // Validation Methods

    public function rules()
    {
        return [
            'firstName' => 'required|min:2',
            'lastName' => 'required|min:2',
            'contactNumber' => 'required|digits:9|numeric',
            'selectedFirstName' => 'required|min:2',
            'selectedLastName' => 'required|min:2',
            'selectedContactNumber' => 'required|digits:9|numeric'
        ];
    }

    public function messages()
    {
        return [
            'firstName.required' => ':attribute is missing.',
            'firstName.min' => ':attribute is too short.',
            'lastName.required' => ':attribute is missing.',
            'lastName.min' => ':attribute is too short.',
            'contactNumber.required' => ':attribute is missing.',
            'contactNumber.numeric' => ':attribute cannot contain letters.',

            'selectedFirstName.required' => ':attribute is missing.',
            'selectedFirstName.min' => ':attribute is too short.',
            'selectedLastName.required' => ':attribute is missing.',
            'selectedLastName.min' => ':attribute is too short.',
            'selectedContactNumber.required' => ':attribute is missing.',
            'selectedContactNumber.numeric' => ':attribute cannot contain letters.',

        ];
    }

    public function validationAttributes()
    {
        return [
            'firstName' => 'First name',
            'lastName' => 'Last name',
            'contactNumber' => 'Contact Number',
            'selectedFirstName' => 'First name',
            'selectedLastName' => 'Last name',
            'selectedContactNumber' => 'Contact Number',
        ];
    }

    // Record Methods

    public function action($id)
    {
        $patient = Patient::find($id);
        $this->reset();
        $this->resetErrorBag();

        $this->selectedId = $patient->id;
        $this->firstName = $patient->first_name;
        $this->lastName = $patient->last_name;
        $this->selectedFirstName = $patient->first_name;
        $this->selectedLastName = $patient->last_name;
        $this->selectedContactNumber = substr($patient->contact_number, 2);
        $this->dispatch('open-modal', name: 'action-modal');
    }

    public function confirmDelete($id)
    {
        $patient = Patient::find($id);
        $this->selectedId = $patient->id;
        $this->selectedFirstName = $patient->first_name;
        $this->selectedLastName = $patient->last_name;
        $this->selectedContactNumber = $patient->contact_number;

        $this->dispatch('open-modal-confirm', name: 'delete-confirm');
    }

    public function add()
    {
        $this->reset();
        $this->resetErrorBag();
        $this->dispatch('open-modal', name: 'add-patient');
    }

    public function update($id)
    {
        $this->validate([
            'selectedFirstName' => 'required|min:2',
            'selectedLastName' => 'required|min:2',
            'selectedContactNumber' => 'required|digits:9|numeric',
        ]);

        $patient = Patient::find($id);

        if ($patient) {
            $patient->first_name = $this->selectedFirstName;
            $patient->last_name = $this->selectedLastName;
            $patient->contact_number = '09' . $this->selectedContactNumber;
            $patient->save();
            session()->flash('success', 'Patient updated!');
        } else {
            session()->flash('error', 'Patient not found!');
        }

        return $this->redirect('/patients', navigate: true);
    }

    public function save()
    {
        $this->validate([
            'firstName' => 'required|min:2',
            'lastName' => 'required|min:2',
            'contactNumber' => 'required|digits:9|numeric',
        ]);

        Patient::create([
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'contact_number' => '09' . $this->contactNumber,
        ]);

        session()->flash('success', 'Patient added!');

        return $this->redirect('/patients', navigate: true);
    }

    public function delete()
    {
        $patient = Patient::find($this->selectedId);
        $patient->delete();

        session()->flash('success', 'Patient removed!');

        return $this->redirect('/patients', navigate: true);
    }

    public function render()
    {
        $patients = Patient::query()
            ->where('first_name', 'like', "%{$this->search}%")
            ->orWhere('last_name', 'like', "%{$this->search}%")
            ->orWhere('contact_number', 'like', "%{$this->search}%")
            ->orderBy('first_name')
            ->paginate(10);

        return view('livewire.patients.patients', [
            'patients' => $patients,
        ]);
    }
}
