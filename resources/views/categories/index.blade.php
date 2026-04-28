@extends('layouts.app')

@section('title', 'Manage Categories')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Manage Categories</h1>
        <p class="muted">Create and organize article categories.</p>
    </div>

    <div class="toolbar">
        <a class="btn btn-primary" href="{{ route('manage.categories.create') }}">Create category</a>
    </div>

    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    @error('category')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Articles</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->articles_count }}</td>
                    <td>
                        <div class="actions">
                            <a class="btn-link" href="{{ route('manage.categories.edit', $category) }}">Edit</a>
                            <form action="{{ route('manage.categories.destroy', $category) }}" method="POST" class="inline-form">
                            @csrf
                            @method('DELETE')
                                <button class="btn-link" type="submit" onclick="return confirm('Delete this category?')">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="empty-state">No categories found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
