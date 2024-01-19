@extends('layouts.app')
@section('content')
    <section id="technologies-index" class="container">
        <h1 class="mb-4 mt-2">Technologies List</h1>

        @if (!empty(session('message')))
            <div class="alert alert-success" role="alert">
                {{ session('message') }}
            </div>
        @endif

        @foreach ($technologies as $technology)
            <div href="{{ route('admin.technologies.show', $technology->slug) }}"
                class="mt-2 d-block position-relative border border-success border-2 p-3 rounded fw-bold text-white bg-dark text-capitalize">
                {{ $technology->name }}
                <a href="{{ route('admin.technologies.show', $technology->slug) }}">
                    <i class="fa-solid fa-eye position-absolute top-25 end-0 text-success me-1 fs-5"></i>
                </a>
                @if (Auth::id() == 1)
                    <a href="{{ route('admin.technologies.edit', $technology->slug) }}">
                        <i class="fa-solid fa-pen-to-square position-absolute top-25 text-primary me-1 fs-5"
                            style="right: 25px"></i>
                    </a>
                    <form action="{{ route('admin.technologies.destroy', $technology->slug) }}" method="POST"
                        class="position-absolute me-1" style="right: 52px; top: 16px">
                        @csrf
                        @method('DELETE')
                        <a href="{{ route('admin.technologies.destroy', $technology->slug) }}"
                            class="text-danger cancel-button" data-item-title="{{ $technology->name }}" type="submit">
                            <i class="fa-solid fa-trash text-danger fs-5"></i>
                        </a>
                    </form>
                @endif

            </div>
        @endforeach
        <button class="btn btn-primary mt-3">
            <a class="text-white text-decoration-none" href="{{ route('admin.technologies.create') }}">Create</a>
        </button>
    </section>
    @include('partials.modal_delete')
@endsection
