@extends('layouts.admin')

@php
    $pageTitle = ((isset($id)) ? "Edit" : "Create")." Logo";
@endphp

@section('title', $pageTitle)

@section('content')
    
    <h1>{{ $pageTitle }}:</h1>
    
    @include('admin.partials.backToMenuBtn')
    @include('admin.partials.customMessages')
    
    <form 
        action="{{ isset($id) ? '/admin/logos/'.$id : '/admin/logos' }}" 
        method="post" 
        enctype="multipart/form-data" {{-- Required to make the file upload work correctly --}}
    >
        @csrf
        
        @if(isset($id))
            @method('PATCH')
        @endif
        
        <div class="form-group">
            
            @include('admin.partials.inputContainer', [
                'inputName' => 'name',
                'inputLabel' => 'Logo Name:',
                'inputField' => '<input 
                    type="text" 
                    class="form-control" 
                    name="name" 
                    id="nameInput" 
                    value="'.($logoName ?? (old('name'))).'" 
                    required 
                />'
            ])
            
            {{-- Not using the inputContainer partial here, due to the logoUploadPreview img --}}
            <div class="inputContainer">
                <label for="file">
                    {{ isset($fileUrl) ? "Replace" : "Upload" }} Image File:
                </label>
                
                <br/>
                <img 
                    id="logoUploadPreview" 
                    src="{{ (isset($fileUrl)) ? url($fileUrl) : '' }}" 
                    style="{{ (!isset($fileUrl)) ? 'display: none;' : '' }}"
                />
                
                <input 
                    type="file" 
                    class="form-control" 
                    accept="image/*" 
                    name="file" 
                    id="fileInput" 
                    @if(!isset($fileUrl))
                        required
                    @endif
                />
                @include('admin.partials.inputError', ['errorName' => 'file'])
                <script src="/js/logoPreviewHandler.js"></script>
            </div>
            
        </div>
        
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
    
    @include('admin.partials.deleteForm')
@endsection