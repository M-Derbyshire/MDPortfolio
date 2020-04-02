@extends('layouts.public')

@section('title', 'My Work')
@section('secondaryStyleSheet', asset('css/projectsStyle.css'))

@section('content')
    <div class="row justify-content-center">
        <header id="projectHeader">
            <h1>My Work</h1>
            <hr />
        </header>
    </div>
    
    <div class="row" id="backToHomeBtn">
        <div class="col-9 offset-1">
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
                            {!! $projects[$i]->smallDescription !!} {{-- This is properly prepared in the controller --}}
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