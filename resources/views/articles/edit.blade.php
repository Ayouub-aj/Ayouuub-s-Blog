@extends('layouts.app')

@section('title', 'Edit Article')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Edit Article</h1>
        <p class="muted">Update article content, category, or publication status.</p>
    </div>

    <form action="{{ route('articles.update', $article) }}" method="POST" class="card form-card">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Title</label>
            <input id="title" type="text" name="title" value="{{ old('title', $article->title) }}" required maxlength="255">
            @error('title')
                <div class="error-text">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="content">Content</label>
            <textarea id="content" name="content" rows="8" required>{{ old('content', $article->content) }}</textarea>
            @error('content')
                <div class="error-text">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="category_id">Category</label>
            <select id="category_id" name="category_id" required>
                @foreach ($categories as $category)
                    <option
                        value="{{ $category->id }}"
                        @selected((int) old('category_id', $article->category_id) === $category->id)
                    >
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <div class="error-text">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select id="status" name="status" required>
                <option value="draft" @selected(old('status', $article->status) === 'draft')>Draft</option>
                <option value="published" @selected(old('status', $article->status) === 'published')>Published</option>
            </select>
            @error('status')
                <div class="error-text">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
