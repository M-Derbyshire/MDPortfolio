{{-- If creating, this can be done by any user. If editing, then only by the logged in
    user can edit themselves --}}
    
    @extends('layouts.admin')

@php
    $pageTitle = ((isset($id)) ? "Edit My Account" : "Create New User");
@endphp

@section('title', $pageTitle)

@section('content')
    
    <h1>{{ $pageTitle }}:</h1>
    
    @include('admin.partials.backToMenuBtn')
    @include('admin.partials.customErrors')
    
    <form 
        action="{{ isset($id) ? '/admin/users/edit/'.$id : '/admin/users/store' }}" 
        method="post" 
    >
        @csrf
        
        @if(isset($id))
            @method('PATCH')
        @endif
        
        <div class="form-group">
            
            @include('admin.partials.inputContainer', [
                'inputName' => 'email',
                'inputLabel' => 'Email Address:',
                'inputField' => '<input 
                    type="text" 
                    class="form-control" 
                    name="email" 
                    id="emailInput" 
                    value="'.($email ?? (old('email'))).'" 
                    required 
                />'
            ])
            
            @include('admin.partials.inputContainer', [
                'inputName' => 'name',
                'inputLabel' => "User's Name:",
                'inputField' => '<input 
                    type="text" 
                    class="form-control" 
                    name="name" 
                    id="nameInput" 
                    value="'.($name ?? (old('name'))).'" 
                    required 
                />'
            ])
            
            
            {{-- User's can change their own password on a seperate form, elsewhere --}}
            @if(!isset($id))
                @include('admin.partials.inputContainer', [
                    'inputName' => 'password',
                    'inputLabel' => "Password:",
                    'inputField' => '<input 
                        type="password" 
                        class="form-control" 
                        name="password" 
                        id="passwordInput" 
                        value="" 
                        required 
                    />'
                ])
                
                @include('admin.partials.inputContainer', [
                    'inputName' => 'password_confirmation',
                    'inputLabel' => "Confirm Password:",
                    'inputField' => '<input 
                        type="password" 
                        class="form-control" 
                        name="password_confirmation" 
                        id="passwordInput_confirmation" 
                        value="" 
                        required 
                    />'
                ])
            @endif
            
        </div>
        
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
    
    @include('admin.partials.deleteForm') {{-- The user can delete their own account --}}
    
@endsection