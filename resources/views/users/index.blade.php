@extends('layouts.app')

@section('title', 'Manage Users')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Manage Users</h1>
        <p class="muted">Create and maintain blogger accounts.</p>
    </div>

    <div class="toolbar">
        <a class="btn btn-primary" href="{{ route('manage.users.create') }}">Create user</a>
    </div>

    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    @error('user')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Articles</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->articles_count }}</td>
                    <td>
                        <div class="actions">
                            <a class="btn-link" href="{{ route('manage.users.edit', $user) }}">Edit</a>
                            <form action="{{ route('manage.users.destroy', $user) }}" method="POST" class="inline-form">
                            @csrf
                            @method('DELETE')
                                <button class="btn-link" type="submit" onclick="return confirm('Delete this user?')">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="empty-state">No users found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
