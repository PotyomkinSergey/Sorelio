@extends('layout.main')
@section('content')
    <h1>Login or <a href="/register">Register</a></h1>
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <form action="/login" method="POST">
        <div class="mb-3">
            <label for="email" class="form-label">Email address <span class="text-danger">*</span></label>
            <input type="email" class="form-control" id="email" name="email" required autocomplete="email">
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
        <br>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
@endsection
