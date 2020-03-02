@extends('layouts.admin')

@php
    $pageTitle = ((isset($id)) ? "Edit" : "Create")." Project";
@endphp

@section('title', $pageTitle)

@section('content')
    
    <h1>{{ $pageTitle }}:</h1>
    
    <form 
        action="{{ isset($id) ? '/admin/projects/edit/'.$id : '/admin/projects/create' }}" 
        method="post" 
    >
        @csrf
        
        @if(isset($id))
            @method('PATCH')
        @endif
        
        <div class="form-group">
            
            <div class="inputContainer">
                <label for="projectTitleInput">Project Title:</label>
                <input 
                    type="text" 
                    class="form-control" 
                    name="projectTitleInput" 
                    id="projectTitleInput" 
                    value="{{ $projectTitle ?? '' }}" 
                    required 
                />
                @include('admin.partials.inputError', ['errorName' => 'titleError'])
            </div>
            
            <div class="inputContainer">
                <label for="projectSmallDescriptionInput">Small Description:</label>
                <textarea 
                    rows="2"
                    class="form-control" 
                    name="projectSmallDescriptionInput" 
                    id="projectSmallDescriptionInput" 
                    value="{{ $projectSmallDescription ?? '' }}" 
                    required 
                ></textarea>
                @include('admin.partials.inputError', ['errorName' => 'smallDescriptionError'])
            </div>
            
            <div class="inputContainer">
                <label for="projectDescriptionInput">Full Description:</label>
                <textarea 
                    rows="8"
                    class="form-control" 
                    name="projectDescriptionInput" 
                    id="projectDescriptionInput" 
                    value="{{ $projectDescription ?? '' }}" 
                    required 
                ></textarea>
                @include('admin.partials.inputError', ['errorName' => 'descriptionError'])
            </div>
            
            @include('admin.partials.logoSelector')
            
            <div class="inputContainer">
                <label for="projectGithubInput">GitHub URL:</label>
                <input 
                    type="text" 
                    class="form-control" 
                    name="projectGithubInput" 
                    id="projectGithubInput" 
                    value="{{ $projectGithubURL ?? '' }}"  
                />
                @include('admin.partials.inputError', ['errorName' => 'githubError'])
            </div>
            
            <div class="inputContainer">
                <label for="projectZipFileInput">
                    {{ isset($zipFileUrl) ? "Replace" : "Upload" }} Zip File:
                </label>
                <input 
                    type="file" 
                    class="form-control" 
                    accept=".zip" 
                    name="projectZipFileInput" 
                    id="projectZipFileInput" 
                />
                @include('admin.partials.inputError', ['errorName' => 'zipFileError'])
            </div>
            
        </div>
        
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
    
    @include('admin.partials.deleteForm')
@endsection