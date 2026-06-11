@php use App\Enums\TaskStatusEnum; @endphp
@extends('layout.main')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Tasks</h2>
    </div>
    <div class="row mb-2">
        <div class="col-md-10">
            <form method="GET" action="/tasks">
                <div class="input-group">
                    <input
                        type="text"
                        name="filter"
                        class="form-control"
                        placeholder="Search in tasks ..."
                        value="{{ request('filter') }}"
                    >
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </form>
        </div>
        <div class="col-md-2">
            <a href="/task/create" class="btn btn-primary">Create task</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{ $tasks->links() }}

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
                        <span class="badge bg-success">{{TaskStatusEnum::DONE->name}}</span>
                    @else
                        <span
                            class="badge bg-warning text-dark">{{$task->status == TaskStatusEnum::DOING->value ? 'Doing' : 'Todo'}}</span>
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
