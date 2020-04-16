@extends('layouts.admin')

@php
    $pageTitle = "Edit Subject Information";
@endphp

@section('title', $pageTitle)

@section('content')
    
    <h1>{{ $pageTitle }}:</h1>
    
    @include('admin.partials.backToMenuBtn')
    @include('admin.partials.customMessages')
    
    <form 
        action="/admin/subject" 
        method="post" 
    >
        @csrf
        
        @if(isset($id))
            @method('PATCH')
        @endif
        
        <div class="form-group">
            
            @include('admin.partials.inputContainer', [
                'inputName' => 'name',
                'inputLabel' => 'Subject\'s Name:',
                'inputField' => '<input 
                    type="text" 
                    class="form-control" 
                    name="name" 
                    id="nameInput" 
                    value="'.($subjectName ?? (old('name'))).'" 
                />'
            ])
            
            @include('admin.partials.inputContainer', [
                'inputName' => 'profession',
                'inputLabel' => 'Subject\'s Profession:',
                'inputField' => '<input 
                    type="text" 
                    class="form-control" 
                    name="profession" 
                    id="professionInput" 
                    value="'.($subjectProfession ?? (old('profession'))).'" 
                />'
            ])
            
            @include('admin.partials.inputContainer', [
                'inputName' => 'whyTop',
                'inputLabel' => 'Subject\'s Why Statment (Line 1):',
                'inputField' => '<input 
                    type="text" 
                    class="form-control" 
                    name="whyTop" 
                    id="whyTopInput" 
                    value="'.($subjectWhyTop ?? (old('whyTop'))).'" 
                />'
            ])
            
            @include('admin.partials.inputContainer', [
                'inputName' => 'whyBottom',
                'inputLabel' => 'Subject\'s Why Statment (Line 2):',
                'inputField' => '<input 
                    type="text" 
                    class="form-control" 
                    name="whyBottom" 
                    id="whyBottomInput" 
                    value="'.($subjectWhyBottom ?? (old('whyBottom'))).'" 
                />'
            ])
            
            @include('admin.partials.inputContainer', [
                'inputName' => 'email',
                'inputLabel' => 'Subject\'s Email Address:',
                'inputField' => '<input 
                    type="text" 
                    class="form-control" 
                    name="email" 
                    id="emailInput" 
                    value="'.($subjectEmail ?? (old('email'))).'" 
                />'
            ])
            
            @include('admin.partials.inputContainer', [
                'inputName' => 'phone',
                'inputLabel' => 'Subject\'s Phone Number:',
                'inputField' => '<input 
                    type="text" 
                    class="form-control" 
                    name="phone" 
                    id="phoneInput" 
                    value="'.($subjectPhone ?? (old('phone'))).'" 
                />'
            ])
            
        </div>
        
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
    
@endsection