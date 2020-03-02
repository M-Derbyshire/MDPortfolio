@extends('layouts.admin')

@php
    $pageTitle = ((isset($id)) ? "Edit" : "Create")." About Link";
@endphp

@section('title', $pageTitle)

@section('content')
    
    <h1>{{ $pageTitle }}:</h1>
    
    <form 
        action="{{ isset($id) ? '/admin/aboutlinks/edit/'.$id : '/admin/aboutlinks/create' }}" 
        method="post" 
    >
        @csrf
        
        @if(isset($id))
            @method('PATCH')
        @endif
        
        <div class="form-group">
            
            <div class="inputContainer">
                <label for="linkNameInput">Link Name:</label>
                <input 
                    type="text" 
                    class="form-control" 
                    name="linkNameInput" 
                    id="linkNameInput" 
                    value="{{ $linkName ?? '' }}" 
                    required 
                />
                @include('admin.partials.inputError', ['errorName' => 'nameError'])
            </div>
            
            <div class="inputContainer">
                <label for="linkTextInput">Link Caption:</label>
                <input 
                    type="text" 
                    class="form-control" 
                    name="linkTextInput" 
                    id="linkTextInput" 
                    value="{{ $linkText ?? '' }}" 
                    required 
                />
                @include('admin.partials.inputError', ['errorName' => 'textError'])
            </div>
            
            <div class="inputContainer">
                <label for="linkUrlInput">Link URL:</label>
                <input 
                    type="text" 
                    class="form-control" 
                    name="linkUrlInput" 
                    id="linkUrlInput" 
                    value="{{ $linkURL ?? '' }}" 
                    required 
                />
                @include('admin.partials.inputError', ['errorName' => 'urlError'])
            </div>
            
            @include('admin.partials.logoSelector')
            
        </div>
        
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
    
    @include('admin.partials.deleteForm')
@endsection