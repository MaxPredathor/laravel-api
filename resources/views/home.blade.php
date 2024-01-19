@extends('layouts.app')
@section('content')
    <section class="container">
        <h1>Section title</h1>
        <a class="btn btn-primary" href="{{ route('admin.projects.index') }}">See Here</a>
    </section>
@endsection
