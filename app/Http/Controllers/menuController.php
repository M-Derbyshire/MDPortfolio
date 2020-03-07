<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class menuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $menuItems = [
            [ 'name' => 'testItem', 'url' => '/admin/testItem' ]
        ];
        
        return view('admin.menu', [
            'pageTitle' => 'Portfolio CMS Menu',
            'title' => 'Portfolio CMS',
            'subtitle' => 'Content Management System',
            'menuItems' => $menuItems,
        ]);
    }
}
