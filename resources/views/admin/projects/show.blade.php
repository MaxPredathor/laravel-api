@php
    use GrahamCampbell\Markdown\Facades\Markdown;
    $markdownContent = $project->body; // La tua stringa Markdown
    $htmlContent = Markdown::convertToHtml($markdownContent); // Utilizza la libreria di Markdown di Laravel
@endphp
@extends('layouts.app')
@section('content')
    <section id="markdown-content" class="container">
        <h1>{{ $project->title }}</h1>
        <p class="text-white">{!! $htmlContent !!}</p>
        <img class="w-50" src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}">
        <div class="my-4">
            <h4 class="d-inline">Technologies:</h4>
            {{-- @for ($i = 0; $i < count($project->technologies); $i++)
                <div class="d-inline-block m-2 ">
                    <img style="width: 50px" src="{{ $project->technologies[$i] }}" alt="">
                </div>
            @endfor --}}
            @if ($project->technologies)
                @foreach ($project->technologies as $item)
                    {{-- <li><a class="text-white text-decoration-none"
                                href="{{ route('admin.technologies.show', $item->slug) }}">{{ $item->name }}</a></li> --}}
                    <img style="width: 50px" src="{{ $item->image }}" alt="{{ $item->name }}">
                    {{-- <div>{{ $item->name }}</div> --}}
                @endforeach
            @endif
        </div>

        @if ($project->category)
            <div class="my-4">
                <h4 class="d-inline">Category:</h4>
                <div class="text-white fs-5 px-3 d-inline">
                    {{ $project->category ? $project->category->name : 'Uncategorized' }}
                </div>
            </div>
        @endif


        <div>
            <button class="btn btn-primary d-inline-block"><a class="text-white text-decoration-none"
                    href="{{ route('admin.projects.edit', $project->slug) }}">Edit</button>
            <form class="d-inline-block" action="{{ route('admin.projects.destroy', $project->slug) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger cancel-button" data-item-title="{{ $project->title }}"
                    type="submit">Delete</button>
            </form>
            <button class="btn btn-warning d-inline-block"><a class="text-black text-decoration-none"
                    href="{{ route('admin.projects.index') }}">Back</a>
            </button>
        </div>

    </section>
    @include('partials.modal_delete')
@endsection
