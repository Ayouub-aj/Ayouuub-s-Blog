@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Dashboard</h1>
        <p class="muted">Manage your posts, categories, and users in one place.</p>
    </div>

    <div class="toolbar">
        <a class="btn btn-primary" href="{{ route('articles.create') }}">Create new article</a>
        <a class="btn btn-secondary" href="{{ route('manage.categories.index') }}">Manage categories</a>
        <a class="btn btn-secondary" href="{{ route('manage.users.index') }}">Manage users</a>
    </div>

    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Status</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($articles as $article)
                <tr>
                    <td>{{ $article->title }}</td>
                    <td><span class="badge">{{ $article->status }}</span></td>
                    <td>{{ $article->created_at->format('d M Y') }}</td>
                    <td>
                        <div class="actions">
                            <a class="btn-link" href="{{ route('articles.edit', $article) }}">Edit</a>
                            <form action="{{ route('articles.destroy', $article) }}" method="POST" class="inline-form">
                            @csrf
                            @method('DELETE')
                                <button class="btn-link" type="submit" onclick="return confirm('Delete this article?')">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="empty-state">No articles yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
