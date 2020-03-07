@extends('layouts.admin')

@php
    $pageTitle = ((isset($id)) ? "Edit" : "Create")." Tool";
@endphp

@section('title', $pageTitle)

@section('content')
    
    <h1>{{ $pageTitle }}:</h1>
    
    @include('admin.partials.backToMenuBtn')
    @include('admin.partials.customMessages')
    
    <form 
        action="{{ isset($id) ? '/admin/tools/edit/'.$id : '/admin/tools/create' }}" 
        method="post" 
    >
        @csrf
        
        @if(isset($id))
            @method('PATCH')
        @endif
        
        <div class="form-group">
            
            @include('admin.partials.inputContainer', [
                'inputName' => 'toolNameInput',
                'inputLabel' => 'Tool Name:',
                'inputErrorName' => 'nameError',
                'inputField' => '<input 
                    type="text" 
                    class="form-control" 
                    name="toolNameInput" 
                    id="toolNameInput" 
                    value="'.( $toolName ?? '' ).'" 
                    required 
                />'
            ])
            
            
            @include('admin.partials.logoSelector')
            
        </div>
        
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
    
    @include('admin.partials.deleteForm')
@endsection