<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $tasks = Task::where('user_id', auth()->user()->id)
                     ->whereDate('deadline', '<', today())
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

    public function upcoming()
    {
        $tomorrow = Carbon::tomorrow();

        $tasks = Task::where('user_id', auth()->user()->id)
                     ->whereDate('deadline', '>', $tomorrow)
                     ->get();

        return view('upcoming', [
            'tasks' => $tasks,
        ]);
    }

    public function due()
    {
        $today = Carbon::today();

        $tasks = Task::where('user_id', auth()->user()->id)
                     ->whereDate('deadline', $today)
                     ->get();

        $lists = auth()->user()->categories ?? collect();

        // Add a pseudo category for uncategorized tasks
        $uncategorized = new \App\Models\Category();
        $uncategorized->id = 0;
        $uncategorized->title = 'Uncategorized';

        $lists = $lists->prepend($uncategorized);

        return view('due', [
            'tasks' => $tasks,
            'lists' => $lists,
        ]);
    }

    public function dashboard()
    {
        $userId = auth()->user()->id;
        $tomorrow = Carbon::tomorrow();
        $today = Carbon::today();

        $upcomingTasks = Task::where('user_id', $userId)
            ->whereDate('deadline', '>', $tomorrow)
            ->get()
            ->groupBy('category_id');

        $dueTasks = Task::where('user_id', $userId)
            ->whereDate('deadline', $today)
            ->get()
            ->groupBy('category_id');

        $overdueTasks = Task::where('user_id', $userId)
            ->whereDate('deadline', '<', $today)
            ->get()
            ->groupBy('category_id');

        $completedTasks = Task::where('user_id', $userId)
            ->where('completed', true)
            ->get()
            ->groupBy('category_id');

        $latestNotes = \App\Models\Note::orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $formattedDate = \Carbon\Carbon::now()->format('l, j F Y');

        return view('dashboard', [
            'upcomingTasks' => $upcomingTasks,
            'dueTasks' => $dueTasks,
            'overdueTasks' => $overdueTasks,
            'completedTasks' => $completedTasks,
            'latestNotes' => $latestNotes,
            'formattedDate' => $formattedDate,
        ]);
    }

    public function overdue()
    {
        $userId = auth()->user()->id;
        $today = Carbon::today();

        $overdueTasks = Task::where('user_id', $userId)
            ->whereDate('deadline', '<', $today)
            ->get()
            ->groupBy('category_id');

        return view('overdue', [
            'overdueTasks' => $overdueTasks,
        ]);
    }
}
