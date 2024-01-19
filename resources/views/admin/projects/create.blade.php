@extends('layouts.app')
@section('content')
    <section class="container">
        <h1>Projects Create</h1>
        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title"
                    required maxlength="200" minlength="3">
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="body">Body</label>
                <textarea type="text" class="form-control @error('body') is-invalid @enderror" name="body" id="body">{{ old('body') }}</textarea>
                @error('body')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <img id="uploadPreview" class="w-25" src="https://via.placeholder.com/300x200" alt="Placeholder">
            </div>
            <div class="mb-3">
                <label for="image">Image</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image"
                    id="image">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label">Select Category</label>
                <select class="form-control @error('category_id') is-invalid
                @enderror" name="category_id"
                    id="category_id">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            @foreach ($technologies as $technology)
                <div class="d-inline-block mx-2">
                    <input name="technologies_id" id="technologies_id" value="{{ $technology->id }}" type="checkbox">
                    <img style="width: 50px" src="{{ $technology->image }}" alt="{{ $technology->name }}">
                </div>
            @endforeach
            @error('technologies_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div class="my-2">
                <button type="submit" class="btn btn-success">Submit</button>
                <button type="reset" class="btn btn-primary">Reset</button>
            </div>

        </form>
    </section>
@endsection
