<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $menuItems = [
            [ 'name' => 'Logos', 'url' => '/admin/logos' ],
            [ 'name' => 'Tools', 'url' => '/admin/tools' ],
            [ 'name' => 'Projects', 'url' => '/admin/projects' ],
            [ 'name' => 'About Links', 'url' => '/admin/aboutlinks' ],
            [ 'name' => 'Create User', 'url' => '/admin/users/create' ],
            //Will get the authenticated user's data in the controller method for edits and password changes
            [ 'name' => 'Edit My Account', 'url' => '/admin/users/edit' ],
            [ 'name' => 'Change My Password', 'url' => '/admin/users/changepassword' ],
        ];
        
        return view('admin.menu', [
            'pageTitle' => 'Portfolio CMS Menu',
            'title' => 'Portfolio CMS',
            'subtitle' => 'Content Management System',
            'menuItems' => $menuItems,
        ]);
    }
}
