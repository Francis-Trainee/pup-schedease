<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Faculty;
use App\Models\Subject;
use App\Models\Room;
use App\Models\Section;
use App\Models\AcademicYear;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function create()
    {
        return view('admin.schedules.create', [
            'faculties' => Faculty::all(),
            'subjects' => Subject::all(),
            'rooms' => Room::all(),
            'sections' => Section::all(),
            'academicYear' => AcademicYear::where('is_active', true)->first(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'faculty_id' => 'required|exists:faculties,id',
            'subject_id' => 'required|exists:subjects,id',
            'room_id' => 'required|exists:rooms,id',
            'section_id' => 'required|exists:sections,id',
            'day' => 'required',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
        ]);

        Schedule::create([
            'faculty_id' => $request->faculty_id,
            'subject_id' => $request->subject_id,
            'room_id' => $request->room_id,
            'section_id' => $request->section_id,
            'academic_year_id' => AcademicYear::where('is_active', true)->value('id'),
            'day' => $request->day,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        return redirect()->route('schedules.index')
            ->with('success', 'Schedule created successfully');
    }
}
