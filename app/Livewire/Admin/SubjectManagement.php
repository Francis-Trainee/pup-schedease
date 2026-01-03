<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Subject;

class SubjectManagement extends Component
{
    public $showModal = false;
    public $showDeactivateModal = false;

    public $subjectId;
    public $subject_code;
    public $description;
    public $unit;
    public $lec_hours;
    public $lab_hours;

    public $isEdit = false;

    // For deactivate modal
    public $subjectName;

    protected $rules = [
        'subject_code' => 'required|string|max:20',
        'description' => 'required|string|max:255',
        'unit' => 'required|integer|min:0',
        'lec_hours' => 'required|integer|min:0',
        'lab_hours' => 'required|integer|min:0',
    ];

    /* ---------- MODALS ---------- */

    public function openModal()
    {
        $this->resetValidation();
        $this->reset(['subjectId','subject_code','description','unit','lec_hours','lab_hours','isEdit']);
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function confirmDeactivate($id)
    {
        $subject = Subject::findOrFail($id);
        $this->subjectId = $subject->id;
        $this->subjectName = $subject->subject_code;
        $this->showDeactivateModal = true;
    }

    public function closeDeactivateModal()
    {
        $this->reset(['showDeactivateModal','subjectId','subjectName']);
    }

    /* ---------- CRUD ---------- */

    public function save()
    {
        $this->validate();

        Subject::create([
            'subject_code' => $this->subject_code,
            'description' => $this->description,
            'unit' => $this->unit,
            'lec_hours' => $this->lec_hours,
            'lab_hours' => $this->lab_hours,
            'status' => 'active', // default
        ]);

        $this->closeModal();
    }

    public function edit($id)
    {
        $subject = Subject::findOrFail($id);

        $this->subjectId = $subject->id;
        $this->subject_code = $subject->subject_code;
        $this->description = $subject->description;
        $this->unit = $subject->unit;
        $this->lec_hours = $subject->lec_hours;
        $this->lab_hours = $subject->lab_hours;

        $this->isEdit = true;
        $this->showModal = true;
    }

    public function update()
    {
        $this->validate();

        Subject::findOrFail($this->subjectId)->update([
            'subject_code' => $this->subject_code,
            'description' => $this->description,
            'unit' => $this->unit,
            'lec_hours' => $this->lec_hours,
            'lab_hours' => $this->lab_hours,
        ]);

        $this->closeModal();
    }

    public function deactivateSubject()
    {
        $subject = Subject::findOrFail($this->subjectId);
        $subject->update(['status' => 'inactive']);
        $this->closeDeactivateModal();
    }

    public function render()
    {
        return view('livewire.admin.subject-management', [
            'subjects' => Subject::latest()->get(),
        ]);
    }
}
