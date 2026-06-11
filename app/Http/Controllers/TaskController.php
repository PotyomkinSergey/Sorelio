<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Task\IndexAction;
use App\Enums\TaskStatusEnum;
use App\Http\Requests\task\IndexTaskRequest;
use App\Http\Requests\task\StoreTaskRequest;
use App\Models\Task;
use App\Models\User;
use App\services\custom\CustomInterface;
use Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexTaskRequest $request, CustomInterface $customInjection)
    {
        $validated = $request->validated();
        $customInjection->someFunction();
        $tasks = app()->call(IndexAction::class, [
            'validated' => $validated,
        ]);

        return view('task.index', [
            'tasks' => $tasks,
            'filterValue' => $validated['filter'] ?? null,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();

        return view('task.create', [
            'users' => $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $newTask = Task::create([
            'status' => TaskStatusEnum::TODO->value,
            ...$request->validated(),
        ]);

        return redirect('/tasks');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $users = User::all();

        return view('task.create', [
            'task' => $task,
            'users' => $users,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreTaskRequest $request, Task $task)
    {
        if ($request->user()->cannot('update', $task)) {
            abort(403);
        }
        $task->update($request->validated());

        return redirect('/tasks')->with('success', 'Task updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $user = Auth::user();
        if ($user->cannot('update', $task)) {
            abort(403);
        }
        $task->delete();

        return redirect('/tasks')->with('success', 'Task deleted successfully');
    }
}
