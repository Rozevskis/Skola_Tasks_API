<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    // Show all tasks
    public function index()
    {
        $tasks = Task::with('user')->get(); // Load tasks with user data
        return response()->json($tasks);
    }

    // Store a new task
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'completed' => 'boolean',
        ]);

        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'completed' => $request->completed,
            'user_id' => Auth::id(), // Set the authenticated user's ID
        ]);

        return response()->json($task, 201);
    }

    // Update a task
    public function update(Request $request, Task $task)
    {
        // Ensure that the authenticated user owns the task
        if ($task->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'completed' => 'boolean',
        ]);

        $task->update($request->only(['title', 'description', 'completed']));

        return response()->json($task);
    }

    // Delete a task
    public function destroy(Task $task)
    {
        // Ensure that the authenticated user owns the task
        if ($task->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $task->delete();

        return response()->json(['message' => 'Task deleted successfully.']);
    }
}
