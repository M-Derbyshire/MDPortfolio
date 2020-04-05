{{-- Called by the exception handler's render method.
    Useful if the database goes down, or some other
    issue occurs --}}

@extends('layouts.public')

@section('title', 'Problem Loading Page')

@section('content')
    <div class="row">
        <h1 style="">Problem Loading Page</h1>
    </div>
    <hr/>
    <div class="row">
        <p>Sorry, but there is a fault with this site at the moment.</p>
        <p>Please return again at a later time, and we should have the site up and running as normal.</p>
        <p>Sorry for the inconvenience.</p>
    </div>
@endsection