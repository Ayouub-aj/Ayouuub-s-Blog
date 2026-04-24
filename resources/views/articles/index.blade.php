@extends('layouts.app')

@section('styles')
    .page-title {
        font-size: 2rem;
        margin-bottom: 1.5rem;
        color: #1a1a2e;
    }

    .category-filters {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
        margin-bottom: 2rem;
    }

    .category-filters a {
        background: white;
        border: 1px solid #ddd;
        padding: 0.35rem 0.9rem;
        border-radius: 20px;
        text-decoration: none;
        color: #555;
        font-size: 0.85rem;
        transition: all 0.2s;
    }

    .category-filters a:hover,
    .category-filters a.active {
        background: #e94560;
        color: white;
        border-color: #e94560;
    }

    .articles-grid {
        display: grid;
        gap: 1.5rem;
    }

    .article-card {
        background: white;
        border-radius: 8px;
        padding: 1.5rem;
        box-shadow: 0 2px 6px rgba(0,0,0,0.06);
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .article-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 16px rgba(0,0,0,0.1);
    }

    .article-card .meta {
        font-size: 0.8rem;
        color: #888;
        margin-bottom: 0.5rem;
    }

    .article-card .meta span {
        background: #f0f0f0;
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
        color: #1a1a2e;
    }

    .article-card h2 a:hover {
        color: #e94560;
    }

    .article-card p {
        color: #666;
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 1rem;
    }

    .read-more {
        color: #e94560;
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 500;
    }

    .empty-state {
        text-align: center;
        padding: 4rem;
        color: #aaa;
    }
@endsection

@section('content')

    <h1 class="page-title">Latest Articles</h1>

    <div class="category-filters">
        <a href="/">All</a>
        @foreach ($categories as $category)
            <a href="/categories/{{ $category->id }}">{{ $category->name }}</a>
        @endforeach
    </div>

    <div class="articles-grid">
        @forelse ($articles as $article)
            <div class="article-card">
                <div class="meta">
                    <span>{{ $article->category->name }}</span>
                    {{ $article->created_at->format('d M Y') }}
                </div>
                <h2><a href="/articles/{{ $article->id }}">{{ $article->title }}</a></h2>
                <p>{{ Str::limit($article->content, 150) }}</p>
                <a href="/articles/{{ $article->id }}" class="read-more">Read more →</a>
            </div>
        @empty
            <div class="empty-state">
                <p>No articles published yet.</p>
            </div>
        @endforelse
    </div>

@endsection