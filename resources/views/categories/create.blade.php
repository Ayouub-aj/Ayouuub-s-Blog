@extends('layouts.app')

@section('title', 'Create Category')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Create Category</h1>
        <p class="muted">Add a new category for organizing blog posts.</p>
    </div>

    <form action="{{ route('manage.categories.store') }}" method="POST" class="card form-card">
        @csrf

        <div class="form-group">
            <label for="name">Name</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required maxlength="255">
            @error('name')
                <div class="error-text">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection
