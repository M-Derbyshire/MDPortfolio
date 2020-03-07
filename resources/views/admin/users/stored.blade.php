{{-- As editing is only allowed on the user's own account,
    this is the page for after the creation has suceeded --}}
    
    @extends('layouts.admin')

@php
    $pageTitle = "New User Created";
@endphp

@section('title', $pageTitle)

@section('content')
    
    <h1>{{ $pageTitle }}</h1>
    
    @include('admin.partials.backToMenuBtn')
    
@endsection