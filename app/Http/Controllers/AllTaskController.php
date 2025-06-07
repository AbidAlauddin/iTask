<?php

namespace App\Http\Controllers;

use App\Models\Task;

class AllTaskController extends Controller
{
    public function __invoke()
    {
        $tasks = Task::where('user_id', auth()->user()->id)->get();

        $lists = auth()->user()->categories;

        return view('all-task', [
            'tasks' => $tasks,
            'lists' => $lists,
        ]);
    }
}
