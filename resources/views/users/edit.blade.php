@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Edit User</h1>
        <p class="muted">Update user profile details and password if needed.</p>
    </div>

    <form action="{{ route('manage.users.update', $user) }}" method="POST" class="card form-card">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Name</label>
            <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}" required maxlength="255">
            @error('name')
                <div class="error-text">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" required maxlength="255">
            @error('email')
                <div class="error-text">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Password (leave empty to keep current)</label>
            <input id="password" type="password" name="password" minlength="8">
            @error('password')
                <div class="error-text">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
