@extends('layout.main')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Tasks</h2>
        <a href="/task/create" class="btn btn-primary">Create task</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-striped table-bordered align-middle">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Status</th>
                <th>Description</th>
                <th>User</th>
                <th>Deadline</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
        @forelse($tasks as $task)
            <tr>
                <td>{{ $task->id }}</td>
                <td>{{ $task->title }}</td>
                <td>
                    @if($task->isDone())
                        <span class="badge bg-success">{{\App\Enums\TaskStatusEnum::DONE->name}}</span>
                    @else
                        <span class="badge bg-warning text-dark">{{$task->status == \App\Enums\TaskStatusEnum::DOING->value ? 'Doing' : 'Todo'}}</span>
                    @endif
                </td>
                <td>{{ $task->description }}</td>
                <td>{{ $task->user->name }}</td>
                <td>{{ $task->deadline_at }}</td>

                <td class="text-end">
                    <a href="/task/{{ $task->id }}/edit" class="btn btn-sm btn-outline-primary">Edit</a>
                    <form action="/task/{{ $task->id }}/destroy" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger"
                                onclick="return confirm('Delete this task?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="50" class="text-center text-muted">
                    No tasks found
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endsection
