<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Section;

class SectionManagement extends Component
{
    public $showModal = false;

    public $sectionId;
    public $program;
    public $year_level;
    public $section_name;
    public $isEdit = false;

    protected $rules = [
        'program' => 'required|string|max:255',
        'year_level' => 'required|string|max:50',
        'section_name' => 'required|string|max:50',
    ];

    /* ---------- MODALS ---------- */

    public function openModal()
    {
        $this->resetValidation();
        $this->reset(['sectionId','program','year_level','section_name','isEdit']);
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    /* ---------- CRUD ---------- */

    public function save()
    {
        $this->validate();

        Section::create([
            'program' => $this->program,
            'year_level' => $this->year_level,
            'section_name' => $this->section_name,
        ]);

        $this->closeModal();
    }

    public function edit($id)
    {
        $section = Section::findOrFail($id);

        $this->sectionId = $section->id;
        $this->program = $section->program;
        $this->year_level = $section->year_level;
        $this->section_name = $section->section_name;

        $this->isEdit = true;
        $this->showModal = true;
    }

    public function update()
    {
        $this->validate();

        Section::findOrFail($this->sectionId)->update([
            'program' => $this->program,
            'year_level' => $this->year_level,
            'section_name' => $this->section_name,
        ]);

        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.admin.section-management', [
            'sections' => Section::latest()->get(),
        ]);
    }
}
