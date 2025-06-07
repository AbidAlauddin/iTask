<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $tasks = Task::where('user_id', auth()->user()->id)
                     ->whereDate('deadline', today())
                     ->get();

        $lists = auth()->user()->categories;

        return view('my-day', [
            'tasks' => $tasks,
            'lists' => $lists,
        ]);
    }

    public function index()
    {
        $now = Carbon::now();
        $soon = $now->copy()->addDay();

        // Tentukan waktu target yang sangat spesifik (misalnya jam 09:30)
        $targetHour = 9;
        $targetMinute = 30;

        // Cek apakah jam dan menit saat ini sudah mencapai waktu target
        if ($now->hour == $targetHour && $now->minute == $targetMinute) {
            // Jika sudah mencapai waktu target, tampilkan reminder
            $tasksDueSoon = Task::whereBetween('deadline', [$now, $soon])->get();
        } else {
            // Jika belum, tidak menampilkan reminder
            $tasksDueSoon = null;
        }

        $lists = auth()->user()->categories;

        return view('home', compact('tasksDueSoon', 'lists'));
    }
}
