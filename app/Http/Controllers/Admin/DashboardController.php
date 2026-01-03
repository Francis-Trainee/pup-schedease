<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;


class DashboardController extends Controller
{
  public function dashboard()
  {
    return view('admin.partials.dashboard');
  }

  public function faculty_management()
  {
    return view('admin.partials.faculty_management');
  }

  public function subject_management()
  {
    return view('admin.partials.subject_management');
  }

  public function room_management()
  {
    return view('admin.partials.room_management');
  }

  public function section_management()
  {
    return view('admin.partials.section_management');
  }

  public function schedule_management()
  {
    return view('admin.partials.schedule_management');
  }

  public function reports()
  {
    return view('admin.partials.reports');
  }
}
