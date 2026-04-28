@extends('layouts.app')

@section('title', 'Dashboard')

@section('styles')
    .dashboard-hero {
        margin-bottom: 1rem;
    }

    .dashboard-panel {
        border-radius: 14px;
        padding: 1.3rem;
        color: #fff;
        background: linear-gradient(140deg, #0f172a, #1d4ed8);
        box-shadow: 0 16px 30px rgba(30, 64, 175, 0.22);
    }

    .dashboard-panel h1 {
        font-size: 1.8rem;
        margin-bottom: 0.35rem;
    }

    .dashboard-panel p {
        color: #dbeafe;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 0.8rem;
        margin-bottom: 1rem;
    }

    .stat-card {
        background: #ffffff;
        border: 1px solid #dbeafe;
        border-radius: 12px;
        padding: 0.9rem;
    }

    .stat-label {
        color: #64748b;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.03em;
    }

    .stat-value {
        font-size: 1.45rem;
        font-weight: 700;
        color: #1e293b;
    }

    @media (max-width: 900px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }
    }
@endsection

@section('content')
    <div class="dashboard-hero">
        <div class="dashboard-panel">
            <h1>Dashboard</h1>
            <p>Manage your content pipeline: create, refine, publish, and keep your blog organized.</p>
        </div>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <p class="stat-label">Total Articles</p>
            <p class="stat-value">{{ $articles->count() }}</p>
        </div>
        <div class="stat-card">
            <p class="stat-label">Published</p>
            <p class="stat-value">{{ $articles->where('status', 'published')->count() }}</p>
        </div>
        <div class="stat-card">
            <p class="stat-label">Drafts</p>
            <p class="stat-value">{{ $articles->where('status', 'draft')->count() }}</p>
        </div>
    </div>

    <div class="toolbar">
        <a class="btn btn-primary" href="{{ route('articles.create') }}">Create new article</a>
        <a class="btn btn-secondary" href="{{ route('manage.categories.index') }}">Manage categories</a>
        @if (auth()->user()?->email === 'blogger@blog.com')
            <a class="btn btn-secondary" href="{{ route('manage.users.index') }}">Manage users</a>
        @endif
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
