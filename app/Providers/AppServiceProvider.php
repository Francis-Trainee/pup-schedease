<?php

namespace App\Providers;

use App\Models\Room;
use App\Models\Faculty;
use App\Models\Section;
use App\Models\Subject;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('admin.partials.dashboard', function ($view) {
            $view->with('totalFaculties', Faculty::count());
            $view->with('totalSections', Section::count());
            $view->with('totalSubjects', Subject::count());
            $view->with('totalRooms', Room::count());
        });
    }
}
