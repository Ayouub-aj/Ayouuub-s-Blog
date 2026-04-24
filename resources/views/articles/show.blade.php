@extends('layouts.app')

@section('content')

    <a href="/">← Back to articles</a>

    <h1>{{ $article->title }}</h1>
    <small>{{ $article->category->name }} — {{ $article->created_at->format('d M Y') }}</small>

    <hr>

    <p>{{ $article->content }}</p>

@endsection