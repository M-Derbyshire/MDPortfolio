@extends('layouts.public')

@section('title', $project->title)
@section('secondaryStyleSheet', asset('css/projectsStyle.css'))

@section('metaDescription', $project->title.' - Project Page')

@section('socialMediaMeta')
    <meta property="og:title" content="{{ $project->title.' - My Work.' }}">
    <meta property="og:description" content="{{ 'Portfolio Project: '.$project->title }}">
    @php $socialLogo = url('/uploads/logos/'.$project->logo->url) @endphp
@endsection

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
    
    <div class="row d-flex justify-content-center justify-content-sm-start">
        <a href="/projects" class="btn btn-primary btn-sm" id="backToProjectMenuBtn">Back To Menu</a>
    </div>
    
    <div class="row">
        <p>
            {!! $project->description !!}
        </p>
    </div>
    
    @if(isset($project->liveUrl) && $project->liveUrl != '')
        <div class="row projectUrlLink">
            <strong><a href="{{ $project->liveUrl }}" target="_blank">Try Out this Application</a></strong>
        </div>
    @endif
    
    @if(isset($project->githubUrl) && $project->githubUrl != '')
        <div class="row projectUrlLink">
            <strong><a href="{{ $project->githubUrl }}" target="_blank">View this Project on GitHub</a></strong>
        </div>
    @endif
    
    @if(isset($project->zipUrl) && $project->zipUrl != '')
        <div class="row projectUrlLink">
            <strong><a href="/uploads/files/{{ $project->zipUrl }}">Download the Project Files</a></strong>
        </div>
    @endif
@endsection