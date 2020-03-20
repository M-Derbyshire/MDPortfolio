@extends('layouts.public')

@section('title', 'Project Not Found')

@section('content')
    <div class="row">
        <h1>The requested project could not be found.</h1>
    </div>
    <div class="row">
        <a href="/projects" class="btn btn-primary btn-lg" id="notFoundReturnBtn">Return To Menu</a>
    </div>
@endsection