@extends('layouts.app')

@section('title', 'Create User')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Create User</h1>
        <p class="muted">Add a new user account with login access.</p>
    </div>

    <form action="{{ route('manage.users.store') }}" method="POST" class="card form-card">
        @csrf

        <div class="form-group">
            <label for="name">Name</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required maxlength="255">
            @error('name')
                <div class="error-text">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required maxlength="255">
            @error('email')
                <div class="error-text">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input id="password" type="password" name="password" required minlength="8">
            @error('password')
                <div class="error-text">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection
