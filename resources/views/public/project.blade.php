@extends('layouts.public')

@section('title', $project->title)

@section('content')
    <div class="row justify-content-center">
        <header id="projectHeader">
            <h1>{{ $project->title }}</h1>
            <hr />
            <img 
                src="{{ url('/uploads/logos/'.$project->logo->url) }}" 
                alt="Project's Logo" 
            />
            <hr />
        </header>
    </div>
    
    <div class="row">
        <a href="/projects" class="btn btn-primary btn-sm" id="backToProjectMenuBtn">Back To Menu</a>
    </div>
    
    <div class="row">
        <p>
            {!! $project->description !!} {{-- This is properly prepared in the controller --}}
        </p>
    </div>
@endsection