<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalendarController extends Controller
{
    /**
     * Display the calendar page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('calendar.index', ['title' => 'Calendar']);
    }
}
