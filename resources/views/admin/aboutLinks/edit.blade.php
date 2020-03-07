@extends('layouts.admin')

@php
    $pageTitle = ((isset($id)) ? "Edit" : "Create")." About Link";
@endphp

@section('title', $pageTitle)

@section('content')
    
    <h1>{{ $pageTitle }}:</h1>
    
    @include('admin.partials.backToMenuBtn')
    @include('admin.partials.customErrors')
    
    <form 
        action="{{ isset($id) ? '/admin/aboutlinks/edit/'.$id : '/admin/aboutlinks/create' }}" 
        method="post" 
    >
        @csrf
        
        @if(isset($id))
            @method('PATCH')
        @endif
        
        <div class="form-group">
            
            @include('admin.partials.inputContainer', [
                'inputName' => 'linkNameInput',
                'inputLabel' => 'Link Name:',
                'inputErrorName' => 'nameError',
                'inputField' => '<input 
                    type="text" 
                    class="form-control" 
                    name="linkNameInput" 
                    id="linkNameInput" 
                    value="'.($linkName ?? "").'" 
                    required 
                />'
            ])
            
            @include('admin.partials.inputContainer', [
                'inputName' => 'linkTextInput',
                'inputLabel' => 'Link Caption:',
                'inputErrorName' => 'textError',
                'inputField' => '<input 
                    type="text" 
                    class="form-control" 
                    name="linkTextInput" 
                    id="linkTextInput" 
                    value="'.($linkText ?? '').'" 
                    required 
                />'
            ])
            
            @include('admin.partials.inputContainer', [
                'inputName' => 'linkUrlInput',
                'inputLabel' => 'Link URL:',
                'inputErrorName' => 'urlError',
                'inputField' => '<input 
                    type="text" 
                    class="form-control" 
                    name="linkUrlInput" 
                    id="linkUrlInput" 
                    value="'.( $linkURL ?? '' ).'" 
                    required 
                />'
            ])
            
            @include('admin.partials.logoSelector')
            
        </div>
        
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
    
    @include('admin.partials.deleteForm')
@endsection