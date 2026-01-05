<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'faculty_id',
        'subject_id',
        'room_id',
        'section_id',
        'academic_year_id',
        'day',
        'start_time',
        'end_time',
    ];

    public function faculty() {
        return $this->belongsTo(Faculty::class);
    }

    public function subject() {
        return $this->belongsTo(Subject::class);
    }

    public function room() {
        return $this->belongsTo(Room::class);
    }

    public function section() {
        return $this->belongsTo(Section::class);
    }

    public function academicYear() {
        return $this->belongsTo(AcademicYear::class);
    }
}
