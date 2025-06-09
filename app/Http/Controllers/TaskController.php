<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function update(Request $request, Task $task)
    {
        \Log::info('TaskController update request data:', $request->all());

        $this->validate($request, [
            'completed' => 'required|boolean',
        ]);

        $task->completed = $request->boolean('completed');
        $task->save();

        \Log::info('Task updated:', $task->toArray());

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Task updated successfully',
                'task' => $task,
            ]);
        }

        return redirect()->back()->with('success', 'Task updated successfully.');
    }
}
