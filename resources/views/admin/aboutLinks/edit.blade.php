@extends('layouts.admin')

@php
    $pageTitle = ((isset($id)) ? "Edit" : "Create")." About Link";
@endphp

@section('title', $pageTitle)

@section('content')
    
    <h1>{{ $pageTitle }}:</h1>
    
    @include('admin.partials.backToMenuBtn')
    @include('admin.partials.customMessages')
    
    <form 
        action="{{ isset($id) ? '/admin/aboutlinks/'.$id : '/admin/aboutlinks' }}" 
        method="post" 
    >
        @csrf
        
        @if(isset($id))
            @method('PATCH')
        @endif
        
        <div class="form-group">
            
            @include('admin.partials.inputContainer', [
                'inputName' => 'name',
                'inputLabel' => 'Link Name:',
                'inputField' => '<input 
                    type="text" 
                    class="form-control" 
                    name="name" 
                    id="nameInput" 
                    value="'.($linkName ?? (old('name'))).'" 
                    required 
                />'
            ])
            
            @include('admin.partials.inputContainer', [
                'inputName' => 'text',
                'inputLabel' => 'Link Caption:',
                'inputField' => '<input 
                    type="text" 
                    class="form-control" 
                    name="text" 
                    id="textInput" 
                    value="'.($linkText ?? (old('text'))).'" 
                    required 
                />'
            ])
            
            @include('admin.partials.inputContainer', [
                'inputName' => 'url',
                'inputLabel' => 'Link URL:',
                'inputField' => '<input 
                    type="text" 
                    class="form-control" 
                    name="url" 
                    id="urlInput" 
                    value="'.($linkUrl ?? (old('url'))).'" 
                    required 
                />'
            ])
            
            @include('admin.partials.logoSelector')
            
            @include('admin.partials.orderInput')
            
        </div>
        
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
    
    @include('admin.partials.deleteForm')
@endsection