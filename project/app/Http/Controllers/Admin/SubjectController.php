<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
    
    public function update(Request $request) //Also acts as store()
    {
        $this->validator($request);
        
        try
        {
            $subject = \App\Subject::first();
        
            if(is_null($subject))
            {
                $subject = \App\Subject::create([
                    'name' => $request->name,
                    'profession' => $request->profession,
                    'why_top' => $request->whyTop,
                    'why_bottom' => $request->whyBottom,
                    'email' => $request->email,
                    'phone' => $request->phone
                ]);
            }
            else
            {
                $subject->name = $request->name;
                $subject->profession = $request->profession;
                $subject->why_top = $request->whyTop;
                $subject->why_bottom = $request->whyBottom;
                $subject->email = $request->email;
                $subject->phone = $request->phone;
                
                $subject->save();
            }
        }
        catch(Exception $e)
        {
            $errorText = "Unexpected error has occured: ".$e->getMessage();
            return redirect()->back()->with('customErrors', [$errorText])->withInput();
        }
        
        $savedMessage = "Subject has now been updated"; 
        return redirect('/admin/subject')->with('customMessages', [$savedMessage]);
    }
}
