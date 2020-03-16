@extends('layouts.admin')

@php
    $pageTitle = ((isset($id)) ? "Edit" : "Create")." Project";
@endphp

@section('title', $pageTitle)

@section('content')
    
    <h1>{{ $pageTitle }}:</h1>
    
    @include('admin.partials.backToMenuBtn')
    @include('admin.partials.customMessages')
    
    <form 
        action="{{ isset($id) ? '/admin/projects/'.$id : '/admin/projects' }}" 
        method="post" 
        enctype="multipart/form-data" {{-- Required to make the file upload work correctly --}}
    >
        @csrf
        
        @if(isset($id))
            @method('PATCH')
        @endif
        
        <div class="form-group">
            
            @include('admin.partials.inputContainer', [
                'inputName' => 'title',
                'inputLabel' => 'Project Title:',
                'inputField' => '<input 
                    type="text" 
                    class="form-control" 
                    name="title" 
                    id="titleInput" 
                    value="'.($projectTitle ?? (old('title'))).'" 
                    required 
                />'
            ])
            
            @include('admin.partials.inputContainer', [
                'inputName' => 'smallDescription',
                'inputLabel' => 'Small Description:',
                'inputField' => '<textarea 
                    rows="2"
                    class="form-control" 
                    name="smallDescription" 
                    id="smallDescriptionInput" 
                    required 
                >'.($projectSmallDescription ?? (old('smallDescription'))).'</textarea>'
            ])
            
            @include('admin.partials.inputContainer', [
                'inputName' => 'description',
                'inputLabel' => 'Full Description:',
                'inputField' => '<textarea 
                    rows="8"
                    class="form-control" 
                    name="description" 
                    id="descriptionInput" 
                    required 
                >'.($projectDescription ?? (old('description'))).'</textarea>'
            ])
            
            
            @include('admin.partials.logoSelector')
            
            
            @include('admin.partials.inputContainer', [
                'inputName' => 'githubUrl',
                'inputLabel' => 'GitHub URL:',
                'inputField' => '<input 
                    type="text" 
                    class="form-control" 
                    name="githubUrl" 
                    id="githubUrlInput" 
                    value="'.($projectGithubUrl ?? (old('githubUrl'))).'"  
                />'
            ])
            
            @include('admin.partials.inputContainer', [
                'inputName' => 'zipFile',
                'inputLabel' => (isset($zipFileUrl) ? 'Replace' : 'Upload').' Zip File:',
                'inputField' => '<input 
                    type="file" 
                    class="form-control" 
                    name="zipFile" 
                    id="zipFileInput" 
                    {{-- Decided to not only accept zip files here, for versatility's sake --}}
                />'
            ])
            
        </div>
        
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
    
    @include('admin.partials.deleteForm')
@endsection