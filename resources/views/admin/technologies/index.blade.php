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
                class="index-div mt-2 d-flex justify-content-between align-items-center position-relative border border-2 p-3 rounded fw-bold text-white text-capitalize">
                <div>{{ $technology->name }}</div>
                <div class="d-flex gap-3 justify-content-evenly">
                    <a href="{{ route('admin.technologies.show', $technology->slug) }}">
                        <i class="fa-solid fa-eye text-success fs-5"></i>
                    </a>
                    @if (Auth::id() == 1)
                        <a href="{{ route('admin.technologies.edit', $technology->slug) }}">
                            <i class="fa-solid fa-pen-to-square text-primary fs-5"></i>
                        </a>
                        <form action="{{ route('admin.technologies.destroy', $technology->slug) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <a href="{{ route('admin.technologies.destroy', $technology->slug) }}"
                                class="text-danger cancel-button" data-item-title="{{ $technology->name }}" type="submit">
                                <i class="fa-solid fa-trash text-danger fs-5"></i>
                            </a>
                        </form>
                    @endif
                </div>


            </div>
        @endforeach
        <button class="btn btn-primary mt-3">
            <a class="text-white text-decoration-none" href="{{ route('admin.technologies.create') }}">Create</a>
        </button>
    </section>
    @include('partials.modal_delete')
@endsection
