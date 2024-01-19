@extends('layouts.app')
@section('content')
    <section class="container">
        <h1>{{ $technology->name }}</h1>
        <ul>
            @forelse ($technology->projects as $project)
                <li><a href="{{ route('admin.projects.show', $project->slug) }}">{{ $project->title }}</a></li>
            @empty
                <li>No projects</li>
            @endforelse
        </ul>

        <div>
            <button class="btn btn-primary d-inline-block"><a class="text-white text-decoration-none"
                    href="{{ route('admin.technologies.edit', $technology->slug) }}">Edit</button>
            <form class="d-inline-block" action="{{ route('admin.technologies.destroy', $technology->slug) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger cancel-button" data-item-title="{{ $technology->name }}"
                    type="submit">Delete</button>
            </form>
            <button class="btn btn-warning d-inline-block"><a class="text-black text-decoration-none"
                    href="{{ route('admin.technologies.index') }}">Back</a>
            </button>
        </div>

    </section>
    @include('partials.modal_delete')
@endsection
