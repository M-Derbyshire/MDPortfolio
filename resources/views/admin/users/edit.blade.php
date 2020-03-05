{{-- If creating, this can be done by any user. If editing, then only by the logged in
    user can edit themselves --}}
    
    @extends('layouts.admin')

@php
    $pageTitle = ((isset($id)) ? "Edit My Account" : "Create New User");
@endphp

@section('title', $pageTitle)

@section('content')
    
    <h1>{{ $pageTitle }}:</h1>
    
    <form 
        action="{{ isset($id) ? '/admin/users/edit/'.$id : '/admin/users/create' }}" 
        method="post" 
    >
        @csrf
        
        @if(isset($id))
            @method('PATCH')
        @endif
        
        <div class="form-group">
            
            @include('admin.partials.inputContainer', [
                'inputName' => 'emailInput',
                'inputLabel' => 'Email Address:',
                'inputErrorName' => 'emailError',
                'inputField' => '<input 
                    type="email" 
                    class="form-control" 
                    name="emailInput" 
                    id="emailInput" 
                    value="'.($email ?? "").'" 
                    required 
                />'
            ])
            
            @include('admin.partials.inputContainer', [
                'inputName' => 'nameInput',
                'inputLabel' => "User's Name:",
                'inputErrorName' => 'nameError',
                'inputField' => '<input 
                    type="text" 
                    class="form-control" 
                    name="nameInput" 
                    id="nameInput" 
                    value="'.($name ?? "").'" 
                    required 
                />'
            ])
            
            @include('admin.partials.inputContainer', [
                'inputName' => 'passwordInput',
                'inputLabel' => "Password:",
                'inputErrorName' => 'passwordError',
                'inputField' => '<input 
                    type="password" 
                    class="form-control" 
                    name="passwordInput" 
                    id="passwordInput" 
                    value="" 
                    required 
                />'
            ])
            
            @include('admin.partials.inputContainer', [
                'inputName' => 'passwordInput-confirm',
                'inputLabel' => "Confirm Password:",
                'inputErrorName' => 'passwordError',
                'inputField' => '<input 
                    type="password" 
                    class="form-control" 
                    name="passwordInput-confirm" 
                    id="passwordInput-confirm" 
                    value="" 
                    required 
                />'
            ])
            
        </div>
        
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
    
    @include('admin.partials.deleteForm') {{-- The user can delete their own account --}}
    
@endsection