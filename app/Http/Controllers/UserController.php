<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Hash;
use Auth;

class UserController extends Controller
{
    protected $menuURL = "/admin";
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function validator($request)
    {
        $emailRules = 'required|email'.(($request->isMethod('POST')) ? '|unique:users' : '');
        
        $request->validate([
            'name' => 'required',
            'email' => $emailRules,
        ]);
    }
    
    public function passwordValidator($request, $passwordField = 'password')
    {
        $request->validate([
            $passwordField => 'required|min:6|confirmed',
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
        
        return redirect()->route('afterUserStored'); //User's can only edit their own accounts
    }
    
    public function afterStored()
    {
        //User's can only edit their own accounts
        return view('admin.users.stored', ['menuURL' => $this->menuURL]);
    }
    
    
    
    public function edit()
    {
        //User's can only edit their own accounts
        
        $viewData = [
            'menuURL' => $this->menuURL,
            'id' => Auth::id(),
            'email' => Auth::user()->email,
            'name' => Auth::user()->name,
        ];
        
        return view('admin.users.edit', $viewData);
    }
    
    public function update(Request $request)
    {
        $this->validator($request);
        
        try
        {
            $user = Auth::user();
            
            $user->email = $request->email;
            $user->name = $request->name;
            $user->save();
        }
        catch(Exception $e)
        {
            $errorText = "Unexpected error has occured: ".$e->getMessage();
            return redirect()->back()->with('customErrors', [$errorText])->withInput();
        }
        
        $savedMessage = "User account has been updated"; 
        return redirect()->back()->with('customMessages', [$savedMessage]);
    }
    
    public function passwordEdit()
    {
        return view('admin.users.passwordChange', ['menuURL' => $this->menuURL]);
    }
    
    public function passwordUpdate(Request $request)
    {
        $this->passwordValidator($request, 'newPassword');
        
        try
        {
            $user = Auth::user();
            
            if(!Hash::check($request->currentPassword, $user->password))
            {
                $errorText = "The current password you provided is incorrect";
                return redirect()->back()->withErrors(['currentPassword' => $errorText]);
            }
            
            $user->password = Hash::make($request->newPassword);
            $user->save();
        }
        catch(Exception $e)
        {
            $errorText = "Unexpected error has occured: ".$e->getMessage();
            return redirect()->back()->with('customErrors', [$errorText])->withInput();
        }
        
        $savedMessage = "Password has been updated"; 
        return redirect()->back()->with('customMessages', [$savedMessage]);
    }
    
    
    
    public function delete()
    {
        
    }
}
