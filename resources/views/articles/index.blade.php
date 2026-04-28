@extends('layouts.app')

@section('styles')
    .category-filters {
        display: flex;
        gap: 0.55rem;
        flex-wrap: wrap;
        margin-bottom: 1.2rem;
    }

    .category-filters a {
        background: #ffffff;
        border: 1px solid #cbd5e1;
        padding: 0.4rem 0.9rem;
        border-radius: 20px;
        text-decoration: none;
        color: #334155;
        font-size: 0.87rem;
        font-weight: 600;
        transition: all 0.2s;
    }

    .category-filters a:hover,
    .category-filters a.active {
        background: #2563eb;
        color: white;
        border-color: #2563eb;
    }

    .articles-grid {
        display: grid;
        gap: 1rem;
    }

    .article-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 6px 18px rgba(15, 23, 42, 0.04);
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .article-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 16px rgba(0,0,0,0.1);
    }

    .article-card .meta {
        font-size: 0.84rem;
        color: #64748b;
        margin-bottom: 0.5rem;
    }

    .article-card .meta span {
        background: #eff6ff;
        color: #1d4ed8;
        padding: 0.2rem 0.6rem;
        border-radius: 12px;
        margin-right: 0.4rem;
    }

    .article-card h2 {
        font-size: 1.2rem;
        margin-bottom: 0.6rem;
    }

    .article-card h2 a {
        text-decoration: none;
        color: #0f172a;
    }

    .article-card h2 a:hover {
        color: #2563eb;
    }

    .article-card p {
        color: #475569;
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 1rem;
    }

    .read-more {
        color: #2563eb;
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 600;
    }
@endsection

@section('content')
    <div class="page-header">
        <h1 class="page-title">Latest Articles</h1>
        <p class="muted">Discover published posts and browse by category.</p>
    </div>

    <div class="category-filters">
        <a href="{{ route('articles.index') }}" class="{{ request()->routeIs('articles.index') ? 'active' : '' }}">All</a>
        @foreach ($categories as $category)
            <a
                href="{{ route('categories.show', $category) }}"
                class="{{ isset($currentCategory) && $currentCategory->id === $category->id ? 'active' : '' }}"
            >
                {{ $category->name }}
            </a>
        @endforeach
    </div>

    <div class="articles-grid">
        @forelse ($articles as $article)
            <div class="article-card">
                <div class="meta">
                    <span>{{ $article->category->name }}</span>
                    {{ $article->created_at->format('d M Y') }}
                </div>
                <h2><a href="{{ route('articles.show', $article) }}">{{ $article->title }}</a></h2>
                <p>{{ Str::limit($article->content, 150) }}</p>
                <a href="{{ route('articles.show', $article) }}" class="read-more">Read more →</a>
            </div>
        @empty
            <div class="empty-state">
                <p>No articles published yet.</p>
            </div>
        @endforelse
    </div>

    @if ($articles instanceof \Illuminate\Contracts\Pagination\Paginator)
        <div class="pagination-wrap">
            {{ $articles->links('vendor.pagination.clear') }}
        </div>
    @endif

@endsection