@extends('layouts.app')
@section('content')
    <section class="container">
        <h1>{{ $category->name }}</h1>
        <ul>
            @foreach ($category->projects as $project)
                <li><a href="{{ route('admin.projects.show', $project->slug) }}">{{ $project->title }}</a></li>
            @endforeach
        </ul>


        <div>
            <button class="btn btn-primary d-inline-block"><a class="text-white text-decoration-none"
                    href="{{ route('admin.categories.edit', $category->slug) }}">Edit</button>
            <form class="d-inline-block" action="{{ route('admin.categories.destroy', $category->slug) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger cancel-button" data-item-title="{{ $category->name }}"
                    type="submit">Delete</button>
            </form>
            <button class="btn btn-warning d-inline-block"><a class="text-black text-decoration-none"
                    href="{{ route('admin.categories.index') }}">Back</a>
            </button>
        </div>

    </section>
    @include('partials.modal_delete')
@endsection
