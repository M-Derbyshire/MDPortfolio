@extends('layouts.admin')

@section('title', $pageTitle)

@section('content')
    <div id="menuHeader">
        <h2 id="menuTitle">{{ $title }}</h2>
        <h6 id="menuSubTitle">{{ $subtitle }}</h6>
    </div>
    
    <!-- Menu items -->
    <!-- Bootstrap-wise, need to use a div if you want the full bar of the items to be clickable -->
    <div class="list-group">
        @isset($backLink)
            <a href="{{ $backLink }}" class="list-group-item list-group-item-action menuBackLink">Back</a>
        @endisset
        @foreach($menuItems as $item)
            <a href="{{ $item['url'] }}" class="list-group-item list-group-item-action">{{ $item['name'] }}</a>
        @endforeach
    </div>
@endsection