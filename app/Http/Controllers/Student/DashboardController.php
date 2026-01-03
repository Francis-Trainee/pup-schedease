<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;


class DashboardController extends Controller
{
  public function dashboard()
  {
    return view('student.partials.dashboard');
  }

  public function class_schedule()
  {
    return view('student.partials.class_schedule');
  }

  public function laboratory()
  {
    return view('student.partials.laboratory');
  } 
}
