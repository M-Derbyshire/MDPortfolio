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
                'inputErrorName' => 'emailError',
                'inputField' => '<input 
                    type="email" 
                    class="form-control" 
                    name="email" 
                    id="emailInput" 
                    required 
                />'
            ])
            
            @include('admin.partials.inputContainer', [
                'inputName' => 'password',
                'inputLabel' => 'Password:',
                'inputErrorName' => 'passwordError',
                'inputField' => '<input 
                    type="password" 
                    class="form-control" 
                    name="password" 
                    id="passwordInput" 
                    required 
                />'
            ])
            
        </div>
        
        <button type="submit" class="btn btn-primary">Login</button>
    </form>

@endsection