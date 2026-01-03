<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    // Allow mass assignment for these fields
    protected $fillable = [
        'subject_code',
        'description',
        'unit',
        'lec_hours',
        'lab_hours',
        'status',
    ];
}
