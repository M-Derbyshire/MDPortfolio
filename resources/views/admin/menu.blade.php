@extends('layouts.admin')

@section('title', 'Menu')

@section('content')
    <div id="menuHeader">
        <h2 id="menuTitle">MD Portfolio</h2>
        <h6 id="menuSubTitle">Administration Menu</h6>
    </div>
    <!-- <hr /> -->
    
    <!-- Menu items -->
    <!-- Bootstrap-wise, need to use a div if you want the full bar of the items to be clickable -->
    <div class="list-group">
        <a href="/admin/users" class="list-group-item list-group-item-action">Users</a>
        <a href="/admin/logos" class="list-group-item list-group-item-action">Logos</a>
        <a href="/admin/tools" class="list-group-item list-group-item-action">Tools</a>
        <a href="/admin/projects" class="list-group-item list-group-item-action">Projects</a>
        <a href="/admin/aboutlinks" class="list-group-item list-group-item-action">About Links</a>
    </div>
@endsection