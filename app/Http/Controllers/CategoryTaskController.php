<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Category;

class CategoryTaskController extends Controller
{
    public function create(Category $list)
    {
        return view('tasks.create', ['category' => $list]);
    }

    public function store(Request $request, Category $list)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'description' => 'nullable|string|max:255',
            'deadline_date' => 'nullable|date',
            'deadline_time' => 'nullable|string',
        ]);

        $deadline = null;
        if ($request->filled('deadline_date') && $request->filled('deadline_time')) {
            $deadline = \Carbon\Carbon::parse($request->deadline_date . ' ' . $request->deadline_time);
        } elseif ($request->filled('deadline_date')) {
            $deadline = \Carbon\Carbon::parse($request->deadline_date);
        }

        $list->tasks()->create([
            'title' => $request->title,
            'description' => $request->description,
            'deadline' => $deadline,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('lists.show', [$list->id])->with('success', 'Your task has been added.');
    }

    public function edit(Category $list, Task $task)
    {
        return view('tasks.edit', [
            'category' => $list,
            'task' => $task,
        ]);
    }

    public function update(Request $request, Category $list, Task $task)
    {
        \Log::info('Update request data:', $request->all());

        // Conditional validation for partial updates
        if ($request->has('completed') && !$request->has('title') && !$request->has('description') && !$request->has('deadline')) {
            $this->validate($request, [
                'completed' => 'required|boolean',
            ]);
            $task->completed = $request->boolean('completed');
            $task->save();
        } else {
            $this->validate($request, [
                'title' => 'required|string',
                'description' => 'nullable|string|max:255',
                'deadline' => 'nullable|date',
                'completed' => 'nullable|boolean',
            ]);

            $task->update([
                'title' => $request->title,
                'description' => $request->description,
                'deadline' => $request->deadline,
                'completed' => $request->boolean('completed'),
            ]);
        }

        \Log::info('Task updated:', $task->toArray());

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Task updated successfully',
                'task' => $task,
            ]);
        }

        return redirect()->route('lists.show', [$list->id])->with('success', 'Your task has been updated.');
    }

    public function destroy(Category $list, Task $task)
    {
        $this->authorize('delete', $task);

        $task->delete();

        return redirect()->route('lists.show', [$list->id])->with('success', 'Task Deleted.');
    }
}
