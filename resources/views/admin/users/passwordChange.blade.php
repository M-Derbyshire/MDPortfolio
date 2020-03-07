@extends('layouts.admin')

@php
    $pageTitle = 'Change my Password';
    $menuURL = "test/menu";
    $id = 3;
@endphp

@section('title', $pageTitle)

@section('content')
    
    <h1>{{ $pageTitle }}:</h1>
    
    @include('admin.partials.backToMenuBtn')
    @include('admin.partials.customMessages')
    
    <form 
        action="/admin/users/changepassword/{{ $id }}" 
        method="post" 
    >
        @csrf
        
        @method('PATCH')
        
        <div class="form-group">
            
            @include('admin.partials.inputContainer', [
                'inputName' => 'currentPasswordInput',
                'inputLabel' => "Current Password:",
                'inputErrorName' => 'currentPasswordError',
                'inputField' => '<input 
                    type="password" 
                    class="form-control" 
                    name="currentPasswordInput" 
                    id="currentPasswordInput" 
                    value="" 
                    required 
                />'
            ])
            
            @include('admin.partials.inputContainer', [
                'inputName' => 'newPasswordInput',
                'inputLabel' => "New Password:",
                'inputErrorName' => 'newPasswordError',
                'inputField' => '<input 
                    type="password" 
                    class="form-control" 
                    name="newPasswordInput" 
                    id="newPasswordInput" 
                    value="" 
                    required 
                />'
            ])
            
            @include('admin.partials.inputContainer', [
                'inputName' => 'newPasswordInput-confirm',
                'inputLabel' => "Confirm New Password:",
                'inputErrorName' => 'newPasswordError',
                'inputField' => '<input 
                    type="password" 
                    class="form-control" 
                    name="newPasswordInput-confirm" 
                    id="newPasswordInput-confirm" 
                    value="" 
                    required 
                />'
            ])
            
        </div>
        
        <button type="submit" class="btn btn-primary">Change Password</button>
    </form>
    
@endsection