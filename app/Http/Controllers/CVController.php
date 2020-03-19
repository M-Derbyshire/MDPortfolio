<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CVController extends Controller
{
    protected $menuURL = "/admin";
    protected $cvDirectory = "uploads/cvs";
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function validator($request)
    {
        $fileRules = (($request->isMethod('POST')) ? 'required' : '');
        
        $request->validate([
            'selectedLogoID' => 'required|exists:logos,id',
            'file' => $fileRules
        ]);
    }
    
    
    public function edit() //Also acts as create()
    {
        $cv = \App\CV::first();
        $logos = $this->getLogoInfo();
        
        $constantData = [
            'menuURL' => $this->menuURL, 
            'logos' => $logos
        ];
        
        $cvData = (is_null($cv)) ? [] : [
            'id' => $cv->id, 
            'currentLogoId' => $cv->logo_id, 
            'fileUrl' => $this->cvDirectory.'/'.$cv->url,
            'deleteURL' => '/admin/cv'
        ];
        
        return view('admin.cv.edit', array_merge($constantData, $cvData));
    }
    
    public function update(Request $request) //Also acts as store()
    {
        $this->validator($request);
        
        $cv = \App\CV::first();
        
        if(is_null($cv))
        {
            $cv = \App\CV::create([
                'logo_id' => $request->selectedLogoID,
                'url' => '' //Will set the file url below
            ]);
        }
        else
        {
            $cv->logo_id = $request->selectedLogoID;
        }
        
        if(isset($request->file))
        {
            if(isset($cv->url) && $cv->url != '')
            {
                $this->deleteUploadedFile($cv->url, $this->cvDirectory);
            }
            
            $cv->url = $this->storeUploadedFile($request->file, $cv->id, $this->cvDirectory);
        }
        
        $cv->save();
        
        $savedMessage = "C.V has now been updated"; 
        return redirect('/admin/cv')->with('customMessages', [$savedMessage]);
    }
    
    public function destroy()
    {
        $cv = \App\CV::first();
        
        if(isset($cv))
        {
            if(!is_null($cv->url) && $cv->url != '')
            {
                $this->deleteUploadedFile($cv->url, $this->cvDirectory);
            }
            
            $cv->delete();
        }
        else
        {
            return redirect()->back();
        }
        
        return redirect($this->menuURL);
    }
}
