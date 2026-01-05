<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
    protected $fillable = [
        'year_start',
        'year_end',
        'semester',
        'is_active',
    ];
}

