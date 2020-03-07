@extends('layouts.admin')

@php
    $pageTitle = "Admin Login";
@endphp

@section('title', $pageTitle)

@section('content')

<h1>{{ $pageTitle }}:</h1>
    
    <form 
        action="/admin/login" 
        method="post" 
    >
        @csrf
        
        <div class="form-group">
            
            @include('admin.partials.inputContainer', [
                'inputName' => 'email',
                'inputLabel' => 'Email Address:',
                'inputField' => '<input 
                    type="email" 
                    class="form-control" 
                    name="email" 
                    id="emailInput" 
                    value="'.old('email').'" 
                    required 
                />'
            ])
            
            @include('admin.partials.inputContainer', [
                'inputName' => 'password',
                'inputLabel' => 'Password:',
                'inputField' => '<input 
                    type="password" 
                    class="form-control" 
                    name="password" 
                    id="passwordInput" 
                    required 
                />'
            ])
            
            @include('admin.partials.inputError', ['errorName' => 'loginError'])
            
        </div>
        
        <button type="submit" id="loginButton" class="btn btn-primary btn-lg">Login</button>
    </form>

@endsection