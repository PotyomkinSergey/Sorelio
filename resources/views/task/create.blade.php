@php
    use App\Enums\TaskStatusEnum;
@endphp
@extends('layout.main')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="mb-4">Create new task</h2>
            @if ($errors->any())
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <form action="{{ isset($task) ? url('/task/'.$task->id.'/update') : url('/task/store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text"
                           name="title"
                           class="form-control"
                           value="{{ $task->title ?? old('title') }}">
                    @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Description <span class="text-danger">*</span></label>
                    <textarea name="description" rows="4"
                              class="form-control">{{ old('description', $task->description ?? '') }}</textarea>
                    @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">User <span class="text-danger">*</span></label>
                    <select name="user_id" class="form-select">
                        <option value="">-- Select user --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}"
                                {{ old('user_id', $task->user_id ?? '') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>

                    @error('user_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-select" {{ !isset($task) ? 'disabled' : '' }}>
                        @foreach(TaskStatusEnum::cases() as $status)
                            <option value="{{ $status->value }}"
                                {{ old('status', $task->status ?? '') == $status->value ? 'selected' : '' }}>
                                {{ $status->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deadline</label>
                    <input type="datetime-local"
                           name="deadline_at"
                           class="form-control"
                           value="{{ old('deadline_at') }}">

                    @error('deadline_at')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="/tasks" class="btn btn-secondary">Back</a>
                    <button class="btn btn-primary">{{ isset($task) ? 'Edit' : 'Create' }} task</button>
                </div>
            </form>
        </div>
    </div>
@endsection
