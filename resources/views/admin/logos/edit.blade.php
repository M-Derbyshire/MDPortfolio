@extends('layouts.admin')

@php
    $pageTitle = ((isset($id)) ? "Edit" : "Create")." Logo";
@endphp

@section('title', $pageTitle)

@section('content')
    
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
                @include('admin.partials.inputError', ['errorName' => 'nameError'])
            </div>
            
            <div class="inputContainer">
                <label for="logoFileInput">
                    {{ isset($fileUrl) ? "Replace " : "Upload " }}Image File:
                </label>
                
                @if(isset($fileUrl))
                    <br/><img class="logoUploadPreview" src="{{ $fileUrl }}" />
                @endif
                
                <input 
                    type="file" 
                    class="form-control" 
                    accept="image/*" 
                    name="logoFileInput" 
                    id="logoFileInput" 
                    @if(!isset($fileUrl))
                        required
                    @endif
                />
                @include('admin.partials.inputError', ['errorName' => 'fileError'])
            </div>
            
        </div>
        
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
    
    @include('admin.partials.deleteForm')
@endsection