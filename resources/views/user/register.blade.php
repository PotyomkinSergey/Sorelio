@extends('layout.main')
@section('content')
    <h1>Register</h1>
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <form action="/register" method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="name" name="name" required minlength="2" value="{{ old('name') }}">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email address <span class="text-danger">*</span></label>
            <input type="email" class="form-control" id="email" name="email" required autocomplete="email" value="{{ old('email') }}">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
            <input type="password" class="form-control" id="password" minlength="5" name="password" required autocomplete="current-password">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
{{--        <div class="mb-3">--}}
{{--            <label for="password_confirm" class="form-label">Password confirm <span class="text-danger">*</span></label>--}}
{{--            <input type="password" class="form-control" id="password_confirm" minlength="5" name="password_confirm" required autocomplete="current-password">--}}
{{--            @error('password_confirm')--}}
{{--                <div class="invalid-feedback">{{ $message }}</div>--}}
{{--            @enderror--}}
{{--        </div>--}}
        <br>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
@endsection
