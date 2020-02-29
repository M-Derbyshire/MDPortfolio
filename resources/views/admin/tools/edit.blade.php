@extends('layouts.admin')

@php
    $pageTitle = ((isset($id)) ? "Edit" : "Create")." Tool";
@endphp

@section('title', $pageTitle)

@section('content')
    
    <h1>{{ $pageTitle }}:</h1>
    
    <form 
        action="{{ isset($id) ? '/admin/tools/edit/'.$id : '/admin/tools/create' }}" 
        method="post" 
    >
        @csrf
        
        @if(isset($id))
            @method('PATCH')
        @endif
        
        <div class="form-group">
            
            <div class="inputContainer">
                <label for="toolNameInput">Tool Name:</label>
                <input 
                    type="text" 
                    class="form-control" 
                    name="toolNameInput" 
                    id="toolNameInput" 
                    value="{{ $toolName ?? '' }}" 
                    required 
                />
                @error('nameError')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            
            @yield('admin.logos.selector')
            
        </div>
        
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
    
    @if(isset($id))
        <form id="deleteRecordForm" action="/admin/tools/delete/{{$id}}" method="post">
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    @endif
@endsection