@extends('layouts.admin')

@php
    $pageTitle = ((isset($id)) ? "Update" : "Upload")." C.V";
@endphp

@section('title', $pageTitle)

@section('content')
    
    <h1>{{ $pageTitle }}:</h1>
    
    @include('admin.partials.backToMenuBtn')
    @include('admin.partials.customMessages')
    
    <form 
        action="/admin/cv" 
        method="post" 
        enctype="multipart/form-data" {{-- Required to make the file upload work correctly --}}
    >
        @csrf
        
        @if(isset($id))
            @method('PATCH')
        @endif
        
        <div class="form-group">
            
            @include('admin.partials.inputContainer', [
                'inputName' => 'file',
                'inputLabel' => (isset($fileUrl) ? 'Replace' : 'Upload').' C.V File:',
                'inputField' => '<input 
                    type="file" 
                    class="form-control" 
                    name="file" 
                    id="fileInput" 
                />'
            ])
            
            @include('admin.partials.logoSelector')
            
        </div>
        
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
    
    @include('admin.partials.deleteForm')
@endsection