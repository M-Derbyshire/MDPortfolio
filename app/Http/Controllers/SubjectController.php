<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubjectController extends Controller
{
    protected $menuURL = "/admin";
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function validator($request)
    {
        $request->validate([
            'email' => 'nullable|email'
        ]);
    }
    
    public function edit() //Also acts as create()
    {
        $subject = \App\Subject::first();
        
        $constantData = [
            'menuURL' => $this->menuURL
        ];
        
        $subjectData = (is_null($subject)) ? [] : [
            'id' => $subject->id, 
            'subjectName' => $subject->name,
            'subjectProfession' => $subject->profession,
            'subjectWhyTop' => $subject->why_top,
            'subjectWhyBottom' => $subject->why_bottom,
            'subjectEmail' => $subject->email,
            'subjectPhone' => $subject->phone
        ];
        
        return view('admin.subject.edit', array_merge($constantData, $subjectData));
    }
}
