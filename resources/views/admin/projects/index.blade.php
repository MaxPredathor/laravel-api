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
                class="index-div mt-2 d-flex justify-content-between align-items-center position-relative border border-2 p-3 rounded fw-bold text-white">
                <div>{{ $project->title }}</div>
                <div class="d-flex gap-3 justify-content-evenly">
                    <a href="{{ route('admin.projects.show', $project->slug) }}">
                        <i class="fa-solid fa-eye text-success fs-5"></i>
                    </a>
                    <a href="{{ route('admin.projects.edit', $project->slug) }}">
                        <i class="fa-solid fa-pen-to-square text-primary fs-5"></i>
                    </a>
                    <form action="{{ route('admin.projects.destroy', $project->slug) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <a href="{{ route('admin.projects.destroy', $project->slug) }}" class="text-danger cancel-button"
                            data-item-title="{{ $project->title }}" type="submit">
                            <i class="fa-solid fa-trash text-danger fs-5"></i>
                        </a>
                </div>

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
