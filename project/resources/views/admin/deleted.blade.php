@extends('layouts.admin')

@section('title', ucwords($entityName).' Deleted')

@section('content')
    <h1>This {{ $entityName }} has now been deleted.</h1>
    <a class="btn btn-primary" href="{{ $menuURL }}" id="returnToEntityMenuBtn">Return to {{ $entityName }} menu</a>
@endsection