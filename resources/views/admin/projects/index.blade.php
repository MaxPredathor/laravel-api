@extends('layouts.app')
@section('content')
    <section id="projects-index" class="container">
        <h1 class="mb-4 mt-2">Projects List</h1>

        @if (!empty(session('message')))
            <div class="alert alert-success" role="alert">
                {{ session('message') }}
            </div>
        @endif

        @foreach ($projects as $project)
            <div href="{{ route('admin.projects.show', $project->slug) }}"
                class="mt-2 d-block position-relative border border-success border-2 p-3 rounded fw-bold text-white bg-dark">
                {{ $project->title }}
                <a href="{{ route('admin.projects.show', $project->slug) }}">
                    <i class="fa-solid fa-eye position-absolute top-25 end-0 text-success me-1 fs-5"></i>
                </a>
                <a href="{{ route('admin.projects.edit', $project->slug) }}">
                    <i class="fa-solid fa-pen-to-square position-absolute top-25 text-primary me-1 fs-5"
                        style="right: 25px"></i>
                </a>
                <form action="{{ route('admin.projects.destroy', $project->slug) }}" method="POST"
                    class="position-absolute me-1" style="right: 52px; top: 16px">
                    @csrf
                    @method('DELETE')
                    <a href="{{ route('admin.projects.destroy', $project->slug) }}" class="text-danger cancel-button"
                        data-item-title="{{ $project->title }}" type="submit">
                        <i class="fa-solid fa-trash text-danger fs-5"></i>
                    </a>
                </form>
            </div>
        @endforeach
        {{ $projects->links('vendor.pagination.bootstrap-5') }}

        <button class="btn btn-primary mt-3">
            <a class="text-white text-decoration-none" href="{{ route('admin.projects.create') }}">Create</a>
        </button>
    </section>
    @include('partials.modal_delete')
@endsection
