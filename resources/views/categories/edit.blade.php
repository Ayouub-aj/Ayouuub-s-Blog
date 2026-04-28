@extends('layouts.app')

@section('title', 'Edit Category')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Edit Category</h1>
        <p class="muted">Rename this category.</p>
    </div>

    <form action="{{ route('manage.categories.update', $category) }}" method="POST" class="card form-card">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Name</label>
            <input id="name" type="text" name="name" value="{{ old('name', $category->name) }}" required maxlength="255">
            @error('name')
                <div class="error-text">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
