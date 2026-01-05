<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Schedule;
use App\Models\Section;
use App\Models\AcademicYear;
use App\Models\Faculty;
use App\Models\Subject;
use App\Models\Room;

class ScheduleManagement extends Component
{
    use WithPagination;

    // Open/close modals
    public $createModal = false;

    // For creating
    public $academic_year_id, $semester, $section_id, $faculty_id, $subject_id, $room_id, $day, $start_time, $end_time, $status = 'Active';

    // For editing
    public $edit_id;
    public $editModal = false;

    public $program = '';      // For program dropdown
    public $section = '';      // For section dropdown
    public $semesterOptions = '';     // For semester filter
    // public $statusOptions = '';       // For status filter
    public $academicYear = ''; // For academic year filter
    public $search = '';       // For search bar

    public $sections, $faculties, $subjects, $rooms, $academic_years;

    protected $rules = [
        'academic_year_id' => 'required|exists:academic_years,id',
        'semester' => 'required',
        'section_id' => 'required|exists:sections,id',
        'faculty_id' => 'required|exists:faculties,id',
        'subject_id' => 'required|exists:subjects,id',
        'room_id' => 'required|exists:rooms,id',
        'day' => 'required',
        'start_time' => 'required',
        'end_time' => 'required|after:start_time',
    ];

    public function mount()
    {
        $this->sections = Section::all();
        $this->faculties = Faculty::all();
        $this->subjects = Subject::all();
        $this->rooms = Room::all();
        $this->academic_years = AcademicYear::all();
    }

    public function resetForm()
    {
        $this->reset(['academic_year_id', 'semester', 'section_id', 'faculty_id', 'subject_id', 'room_id', 'day', 'start_time', 'end_time', 'status', 'edit_id']);
    }

    public function createSchedule()
    {
        $this->validate();

        Schedule::create([
            'academic_year_id' => $this->academic_year_id,
            'semester' => $this->semester,
            'section_id' => $this->section_id,
            'faculty_id' => $this->faculty_id,
            'subject_id' => $this->subject_id,
            'room_id' => $this->room_id,
            'day' => $this->day,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'status' => $this->status,
        ]);

        session()->flash('message', 'Schedule created successfully!');
        $this->resetForm();
        $this->createModal = false; // Close modal
    }

    public function edit(Schedule $schedule)
    {
        $this->edit_id = $schedule->id;
        $this->academic_year_id = $schedule->academic_year_id;
        $this->semester = $schedule->semester;
        $this->section_id = $schedule->section_id;
        $this->faculty_id = $schedule->faculty_id;
        $this->subject_id = $schedule->subject_id;
        $this->room_id = $schedule->room_id;
        $this->day = $schedule->day;
        $this->start_time = $schedule->start_time;
        $this->end_time = $schedule->end_time;
        $this->status = $schedule->status;

        $this->editModal = true;
    }

    public function updateSchedule()
    {
        $this->validate();

        $schedule = Schedule::findOrFail($this->edit_id);
        $schedule->update([
            'academic_year_id' => $this->academic_year_id,
            'semester' => $this->semester,
            'section_id' => $this->section_id,
            'faculty_id' => $this->faculty_id,
            'subject_id' => $this->subject_id,
            'room_id' => $this->room_id,
            'day' => $this->day,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'status' => $this->status,
        ]);

        session()->flash('message', 'Schedule updated successfully!');
        $this->resetForm();
        $this->editModal = false;
    }

    public function delete(Schedule $schedule)
    {
        $schedule->delete();
        session()->flash('message', 'Schedule deleted successfully!');
    }

    public function render()
    {
        return view('livewire.admin.schedule-management', [

            // TABLE DATA (with pagination)
            'schedules' => Schedule::with([
                'section',
                'faculty',
                'subject',
                'room',
                'academicYear',
            ])
                ->when($this->program, function ($q) {
                    $q->whereHas('section', function ($sec) {
                        $sec->where('program', $this->program);
                    });
                })
                ->when($this->section, function ($q) {
                    $q->where('section_id', $this->section);
                })
                ->when($this->semester, function ($q) {
                    $q->where('semester', $this->semester);
                })
                // ->when($this->status, function ($q) {
                //     $q->where('status', $this->status);
                // })
                ->when($this->search, function ($q) {
                    $q->whereHas(
                        'subject',
                        fn($sub) =>
                        $sub->where('subject_name', 'like', '%' . $this->search . '%')
                    )
                        ->orWhereHas(
                            'faculty',
                            fn($f) =>
                            $f->where('full_name', 'like', '%' . $this->search . '%')
                        );
                })
                ->latest()
                ->paginate(10),

            // PROGRAM DROPDOWN (distinct strings)
            'programs' => Section::select('program')
                ->distinct()
                ->orderBy('program')
                ->pluck('program'),

            // SECTION DROPDOWN (depends on program)
            'sections' => Section::when(
                $this->program,
                fn($q) => $q->where('program', $this->program)
            )->get(),

            // ACADEMIC YEAR DROPDOWN (if needed)
            'academic_years' => \App\Models\AcademicYear::all(),
        ]);
    }
}
