@extends('layouts.admin')

@php
    $pageTitle = 'Change My Password';
@endphp

@section('title', $pageTitle)

@section('content')
    
    <h1>{{ $pageTitle }}:</h1>
    
    @include('admin.partials.backToMenuBtn')
    @include('admin.partials.customMessages')
    
    <form 
        action="/admin/users/updatepassword" 
        method="post" 
    >
        @csrf
        
        @method('PATCH')
        
        <div class="form-group">
            
            @include('admin.partials.inputContainer', [
                'inputName' => 'currentPassword',
                'inputLabel' => "Current Password:",
                'inputField' => '<input 
                    type="password" 
                    class="form-control" 
                    name="currentPassword" 
                    id="currentPasswordInput" 
                    value="" 
                    required 
                />'
            ])
            
            @include('admin.partials.inputContainer', [
                'inputName' => 'newPassword',
                'inputLabel' => "New Password:",
                'inputField' => '<input 
                    type="password" 
                    class="form-control" 
                    name="newPassword" 
                    id="newPasswordInput" 
                    value="" 
                    required 
                />'
            ])
            
            @include('admin.partials.inputContainer', [
                'inputName' => 'newPassword_confirmation',
                'inputLabel' => "Confirm New Password:",
                'inputField' => '<input 
                    type="password" 
                    class="form-control" 
                    name="newPassword_confirmation" 
                    id="newPasswordInput_confirmation" 
                    value="" 
                    required 
                />'
            ])
            
        </div>
        
        <button type="submit" class="btn btn-primary">Change Password</button>
    </form>
    
@endsection