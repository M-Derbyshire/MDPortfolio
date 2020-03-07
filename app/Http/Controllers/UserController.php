<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Hash;

class UserController extends Controller
{
    protected $menuURL = "/admin";
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function validator($request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
        ]);
    }
    
    public function passwordValidator($request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);
    }
    
    
    
    public function create()
    {
        return view('admin.users.edit', ['menuURL' => $this->menuURL]);
    }
    
    public function store(Request $request)
    {
        $this->validator($request);
        $this->passwordValidator($request);
        
        try
        {
            \App\User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
        }
        catch(Exception $e)
        {
            $errorText = "Unexpected error has occured: ".$e->getMessage();
            return redirect()->back()->with('customErrors', [$errorText])->withInput();
        }
        
        return redirect()->route('afterUserStored');
    }
    
    public function afterStored()
    {
        return view('admin.users.stored', ['menuURL' => $this->menuURL]);
    }
    
    
    
    
    
    public function delete()
    {
        
    }
}
