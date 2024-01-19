@extends('layouts.app')
@section('content')
    <section id="categories-index" class="container">
        <h1 class="mb-4 mt-2">Categories List</h1>

        @if (!empty(session('message')))
            <div class="alert alert-success" role="alert">
                {{ session('message') }}
            </div>
        @endif

        @foreach ($categories as $category)
            <div href="{{ route('admin.categories.show', $category->slug) }}"
                class="mt-2 d-block position-relative border border-success border-2 p-3 rounded fw-bold text-white bg-dark">
                {{ $category->name }}
                <a href="{{ route('admin.categories.show', $category->slug) }}">
                    <i class="fa-solid fa-eye position-absolute top-25 end-0 text-success me-1 fs-5"></i>
                </a>
                @if (Auth::id() == 1)
                    <a href="{{ route('admin.categories.edit', $category->slug) }}">
                        <i class="fa-solid fa-pen-to-square position-absolute top-25 text-primary me-1 fs-5"
                            style="right: 25px"></i>
                    </a>
                    <form action="{{ route('admin.categories.destroy', $category->slug) }}" method="POST"
                        class="position-absolute me-1" style="right: 52px; top: 16px">
                        @csrf
                        @method('DELETE')
                        <a href="{{ route('admin.categories.destroy', $category->slug) }}" class="text-danger cancel-button"
                            data-item-title="{{ $category->name }}" type="submit">
                            <i class="fa-solid fa-trash text-danger fs-5"></i>
                        </a>
                    </form>
                @endif
            </div>
        @endforeach
        <button class="btn btn-primary mt-3">
            <a class="text-white text-decoration-none" href="{{ route('admin.categories.create') }}">Create</a>
        </button>
    </section>
    @include('partials.modal_delete')
@endsection
