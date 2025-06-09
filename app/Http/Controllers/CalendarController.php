<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Carbon\Carbon;

class CalendarController extends Controller
{
    /**
     * Display the calendar page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $currentDate = Carbon::now();
        $tasks = Task::whereYear('deadline', $currentDate->year)
            ->whereMonth('deadline', $currentDate->month)
            ->get(['id', 'title', 'deadline']);

        return view('calendar.index', [
            'title' => 'Calendar',
            'tasks' => $tasks,
        ]);
    }
}
