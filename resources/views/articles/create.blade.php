@extends('layouts.app')

@section('title', 'Create Article')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Create Article</h1>
        <p class="muted">Write a new post and choose its visibility status.</p>
    </div>

    <form action="{{ route('articles.store') }}" method="POST" class="card form-card">
        @csrf

        <div class="form-group">
            <label for="title">Title</label>
            <input id="title" type="text" name="title" value="{{ old('title') }}" required maxlength="255">
            @error('title')
                <div class="error-text">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="content">Content</label>
            <textarea id="content" name="content" rows="8" required>{{ old('content') }}</textarea>
            @error('content')
                <div class="error-text">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="category_id">Category</label>
            <select id="category_id" name="category_id" required>
                <option value="">Select a category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected((int) old('category_id') === $category->id)>
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
                <option value="draft" @selected(old('status', 'draft') === 'draft')>Draft</option>
                <option value="published" @selected(old('status') === 'published')>Published</option>
            </select>
            @error('status')
                <div class="error-text">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection
