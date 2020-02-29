@extends('layouts.admin')

@php
    $pageTitle = ((isset($id)) ? "Edit" : "Create")." Logo";
@endphp

@section('title', $pageTitle)

@section('content')
    
    {{-- Are we editing, or creating? --}}
    <h1>{{ $pageTitle }}:</h1>
    
    <form 
        action="{{ isset($id) ? '/admin/logos/edit/'.$id : '/admin/logos/create' }}" 
        method="post" 
    >
        @csrf
        
        @if(isset($id))
            @method('PATCH')
        @endif
        
        <div class="form-group">
            
            <div class="inputContainer">
                <label for="logoNameInput">Logo Name:</label>
                <input 
                    type="text" 
                    class="form-control" 
                    name="logoNameInput" 
                    id="logoNameInput" 
                    value="{{ $logoName ?? '' }}" 
                    required 
                />
                @error('nameError')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="inputContainer">
                <label for="logoFileInput">
                    {{ isset($id) ? "Replace " : "" }}Image File:
                </label>
                <input 
                    type="file" 
                    class="form-control" 
                    accept="image/*" 
                    name="logoFileInput" 
                    id="logoFileInput" 
                    @if(!isset($fileName))
                        required
                    @endif
                />
                @error('fileError')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            
        </div>
        
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
    
    @if(isset($id))
        <form id="deleteRecordForm" action="/admin/logos/delete/{{$id}}" method="post">
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    @endif
@endsection