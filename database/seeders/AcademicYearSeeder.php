<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AcademicYear;

class AcademicYearSeeder extends Seeder
{
    public function run()
    {
        AcademicYear::create(['year_start' => 2025, 'year_end' => 2026]);
        AcademicYear::create(['year_start' => 2026, 'year_end' => 2027]);
        AcademicYear::create(['year_start' => 2027, 'year_end' => 2028]);
    }
}
