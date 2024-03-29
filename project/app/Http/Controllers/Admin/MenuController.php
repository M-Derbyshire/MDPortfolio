<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
            [ 'name' => 'C.V', 'url' => '/admin/cv' ],
            [ 'name' => 'Subject Information', 'url' => '/admin/subject' ],
            [ 'name' => 'Create User', 'url' => '/admin/users/create' ],
            //Will get the authenticated user's data in the controller method for edits and password changes
            [ 'name' => 'Edit My Account', 'url' => '/admin/users/edit' ],
            [ 'name' => 'Change My Password', 'url' => '/admin/users/updatepassword' ],
        ];
        
        return view('admin.menu', [
            'pageTitle' => 'Portfolio CMS Menu',
            'title' => 'Portfolio CMS',
            'subtitle' => 'Welcome, '.auth()->user()->name,
            'menuItems' => $menuItems,
        ]);
    }
}
