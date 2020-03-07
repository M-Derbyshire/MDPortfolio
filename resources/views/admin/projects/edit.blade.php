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
        action="{{ isset($id) ? '/admin/projects/edit/'.$id : '/admin/projects/create' }}" 
        method="post" 
    >
        @csrf
        
        @if(isset($id))
            @method('PATCH')
        @endif
        
        <div class="form-group">
            
            @include('admin.partials.inputContainer', [
                'inputName' => 'projectTitleInput',
                'inputLabel' => 'Project Title:',
                'inputErrorName' => 'titleError',
                'inputField' => '<input 
                    type="text" 
                    class="form-control" 
                    name="projectTitleInput" 
                    id="projectTitleInput" 
                    value="'.($projectTitle ?? '').'" 
                    required 
                />'
            ])
            
            @include('admin.partials.inputContainer', [
                'inputName' => 'projectSmallDescriptionInput',
                'inputLabel' => 'Small Description:',
                'inputErrorName' => 'smallDescriptionError',
                'inputField' => '<textarea 
                    rows="2"
                    class="form-control" 
                    name="projectSmallDescriptionInput" 
                    id="projectSmallDescriptionInput" 
                    value="'.( $projectSmallDescription ?? '' ).'" 
                    required 
                ></textarea>'
            ])
            
            @include('admin.partials.inputContainer', [
                'inputName' => 'projectDescriptionInput',
                'inputLabel' => 'Full Description:',
                'inputErrorName' => 'descriptionError',
                'inputField' => '<textarea 
                    rows="8"
                    class="form-control" 
                    name="projectDescriptionInput" 
                    id="projectDescriptionInput" 
                    value="'.( $projectDescription ?? '' ).'" 
                    required 
                ></textarea>'
            ])
            
            
            @include('admin.partials.logoSelector')
            
            
            @include('admin.partials.inputContainer', [
                'inputName' => 'projectGithubInput',
                'inputLabel' => 'GitHub URL:',
                'inputErrorName' => 'githubError',
                'inputField' => '<input 
                    type="text" 
                    class="form-control" 
                    name="projectGithubInput" 
                    id="projectGithubInput" 
                    value="'.( $projectGithubURL ?? '' ).'"  
                />'
            ])
            
            @include('admin.partials.inputContainer', [
                'inputName' => 'projectZipFileInput',
                'inputLabel' => (isset($zipFileUrl) ? 'Replace' : 'Upload').' Zip File:',
                'inputErrorName' => 'zipFileError',
                'inputField' => '<input 
                    type="file" 
                    class="form-control" 
                    accept=".zip" 
                    name="projectZipFileInput" 
                    id="projectZipFileInput" 
                />'
            ])
            
        </div>
        
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
    
    @include('admin.partials.deleteForm')
@endsection