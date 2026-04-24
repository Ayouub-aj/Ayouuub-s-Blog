@extends('layouts.app')

@section('content')

    <h1>Latest Articles</h1>

    {{-- Category filter links --}}
    <div>
        <a href="/">All</a>
        @foreach ($categories as $category)
            <a href="/categories/{{ $category->id }}">{{ $category->name }}</a>
        @endforeach
    </div>

    {{-- Articles list --}}
    @forelse ($articles as $article)
        <div>
            <h2>
                <a href="/articles/{{ $article->id }}">{{ $article->title }}</a>
            </h2>
            <small>{{ $article->category->name }} — {{ $article->created_at->format('d M Y') }}</small>
            <p>{{ Str::limit($article->content, 150) }}</p>
        </div>
    @empty
        <p>No articles published yet.</p>
    @endforelse

@endsection