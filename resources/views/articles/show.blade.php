@extends('layouts.app')

@section('content')
    <div class="toolbar">
        <a class="btn btn-secondary" href="{{ route('articles.index') }}">← Back to articles</a>
    </div>

    <article class="card">
        <div class="page-header">
            <h1 class="page-title">{{ $article->title }}</h1>
            <p class="muted">
                {{ $article->category->name }} · {{ $article->created_at->format('d M Y') }} ·
                {{ max(1, (int) ceil(str_word_count($article->content) / 200)) }} min read
            </p>
        </div>

        <p>{{ $article->content }}</p>
    </article>

@endsection