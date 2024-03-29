@extends('layouts.public')

@section('title', 'My Work')
@section('secondaryStyleSheet', asset('css/projectsStyle.css'))

@section('metaDescription', 'My Projects')

@section('socialMediaMeta')
    <meta property="og:title" content="My Work">
    <meta property="og:description" content="My Portfolio - Projects">
@endsection

@section('content')
    <div class="row justify-content-center">
        <header id="projectListHeader">
            <h1>My Work</h1>
            <hr />
        </header>
    </div>
    
    <div class="row" id="backToHomeBtn">
        <div class="col-md-9 offset-md-1 d-flex justify-content-center justify-content-md-start">
            <a href="/" class="btn btn-primary btn-sm" id="backToHomeBtn">Back to Home</a>
        </div>
    </div>
    
    <div class="row">
        <div class="container-fluid" id="projectListContainer">
            @for($i = 0; $i < count($projects); $i++)
                <div class="row">
                    <div class="col-md-3 col-6 offset-md-1 offset-3">
                        <img 
                            src="{{ url('/uploads/logos/'.$projects[$i]->logo->url) }}" 
                            alt="Project's Logo" 
                        />
                    </div>
                    
                    <div class="col-md-7 col-12">
                        <h3><strong>{{ $projects[$i]->title }}</strong></h3>
                        <br />
                        <p>
                            {!! $projects[$i]->smallDescription !!}
                        </p>
                        <a href="/projects/{{ $projects[$i]->id }}" class="btn btn-secondary">Read More</a>
                    </div>
                </div>
                
                @if($i < count($projects) - 1)
                    <hr />
                @endif
            @endfor
        </div>
    </div>
@endsection