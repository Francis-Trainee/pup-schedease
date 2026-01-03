<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Faculty;

class FacultyManagement extends Component
{
    public $showModal = false;

    public $full_name;
    public $employment_type;
    public $specialization;
    public $units_assigned;
    public $status = 'active';

    public $facultyId;
    public $isEdit = false;

    public $showDeactivateModal = false;
    public $facultyToDeactivate;
    public $facultyName;
    public $facultyUnits;

    protected $rules = [
        'full_name' => 'required|string|max:255',
        'employment_type' => 'required|in:full-time,part-time',
        'specialization' => 'required|string|max:255',
        'units_assigned' => 'required|integer|min:0',
        'status' => 'required|in:active,inactive',
    ];

    public function openModal()
    {
        $this->resetValidation();
        $this->reset();
        $this->isEdit = false;
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function save()
    {
        $this->validate();

        Faculty::create([
            'full_name' => $this->full_name,
            'employment_type' => $this->employment_type,
            'specialization' => $this->specialization,
            'units_assigned' => $this->units_assigned,
            'status' => $this->status,
        ]);

        $this->closeModal();
        session()->flash('success', 'Faculty added successfully!');
    }


    public function edit($id)
    {
        $faculty = Faculty::findOrFail($id);

        $this->facultyId = $faculty->id;
        $this->full_name = $faculty->full_name;
        $this->employment_type = $faculty->employment_type;
        $this->specialization = $faculty->specialization;
        $this->units_assigned = $faculty->units_assigned;
        $this->status = $faculty->status;

        $this->isEdit = true;
        $this->showModal = true;
    }

    public function update()
    {
        $this->validate();

        Faculty::findOrFail($this->facultyId)->update([
            'full_name' => $this->full_name,
            'employment_type' => $this->employment_type,
            'specialization' => $this->specialization,
            'units_assigned' => $this->units_assigned,
            'status' => $this->status,
        ]);

        $this->closeModal();
        session()->flash('success', 'Faculty updated successfully!');
    }
    public function confirmDeactivate($id)
    {
        $faculty = Faculty::findOrFail($id);

        // If already inactive, just activate directly
        if ($faculty->status === 'inactive') {
            $faculty->update(['status' => 'active']);
            return;
        }

        // Show warning modal
        $this->facultyToDeactivate = $faculty->id;
        $this->facultyName = $faculty->full_name;
        $this->facultyUnits = $faculty->units_assigned;
        $this->showDeactivateModal = true;
    }

    public function deactivateFaculty()
    {
        Faculty::findOrFail($this->facultyToDeactivate)
            ->update(['status' => 'inactive']);

        $this->closeDeactivateModal();
    }

    public function closeDeactivateModal()
    {
        $this->reset([
            'showDeactivateModal',
            'facultyToDeactivate',
            'facultyName',
            'facultyUnits',
        ]);
    }



    public function render()
    {
        return view('livewire.admin.faculty-management', [
            'faculties' => Faculty::latest()->get(),
        ]);
    }
}
