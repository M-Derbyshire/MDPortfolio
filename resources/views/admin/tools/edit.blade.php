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
        action="{{ isset($id) ? '/admin/tools/'.$id : '/admin/tools' }}" 
        method="post" 
    >
        @csrf
        
        @if(isset($id))
            @method('PATCH')
        @endif
        
        <div class="form-group">
            
            @include('admin.partials.inputContainer', [
                'inputName' => 'name',
                'inputLabel' => 'Tool Name:',
                'inputField' => '<input 
                    type="text" 
                    class="form-control" 
                    name="name" 
                    id="nameInput" 
                    value="'.($toolName ?? (old('name'))).'" 
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