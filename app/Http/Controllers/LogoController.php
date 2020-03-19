<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;

class LogoController extends Controller
{
    
    protected $menuURL = "/admin/logos/";
    protected $logoDirectory = "uploads/logos";
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function validator($request)
    {
        $fileRules = 'image'.(($request->isMethod('POST')) ? '|required' : '');
        
        $request->validate([
            'name' => 'required',
            'file' => 'image'
        ]);
    }
    
    public function deleteLogo($logo, $directory)
    {
        $this->deleteUploadedFile($logo->url, $directory);
        
        if(method_exists($logo, 'delete'))
        {
            $logo->delete();
        }
    }
    
    
    
    
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logos = \App\Logo::all();
        $menuItems = [];
        
        foreach($logos as $logo)
        {
            array_push($menuItems, [ 'name' => $logo->name, 'url' => '/admin/logos/'.$logo->id.'/edit' ]);
        }
        
        $constantItems = [
            [ 'name' => 'Create Logo', 'url' => '/admin/logos/create' ]
        ];
        
        $allMenuItems = array_merge($constantItems, $menuItems);
        
        return view('admin.menu', [
            'pageTitle' => 'Logos',
            'title' => 'Logos',
            'subtitle' => 'Logos to be used by other elements on the site',
            'backLink' => '/admin',
            'menuItems' => $allMenuItems,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.logos.edit', ['menuURL' => $this->menuURL]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validator($request);
        
        try
        {
            //We want to use the id in the logo file name,
            // so will add the url after the create
            $logo = \App\Logo::create([
                'name' => $request->name,
                'url' => ''
            ]);
            
            $logo->url = $this->storeUploadedFile($request->file, $logo->id, $this->logoDirectory);
            $logo->save();
        }
        catch(Exception $e)
        {
            // Need to delete the new Logo, and then return the error
            if(isset($logo))
            {
                $this->deleteLogo($logo, $this->logoDirectory);
            }
            
            $errorText = "Unexpected error has occured: ".$e->getMessage();
            return redirect()->back()->with('customErrors', [$errorText])->withInput();
        }
        
        $savedMessage = "Logo has successfully been created"; 
        return redirect('/admin/logos/'.$logo->id.'/edit')->with('customMessages', [$savedMessage]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('/admin/logos/'.$id.'/edit');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $logo = \App\Logo::find($id);
        
        if(is_null($logo))
        {
            return $this->recordNotFoundRedirect('/admin/logos/create');
        }
        
        $viewData = [
            'menuURL' => $this->menuURL,
            'deleteURL' => '/admin/logos/'.$logo->id,
            'id' => $logo->id,
            'logoName' => $logo->name,
            'fileUrl' => $this->logoDirectory.'/'.$logo->url,
        ];
        
        return view('admin.logos.edit', $viewData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validator($request);
        
        try
        {
            $logo = \App\Logo::find($id);
            
            if(is_null($logo))
            {
                return redirect()->back();
            }
            
            
            if(isset($request->file))
            {
                $this->deleteUploadedFile($logo->url, $this->logoDirectory);
                
                $logo->url = $this->storeUploadedFile($request->file, $logo->id, $this->logoDirectory);
            }
            
            $logo->name = $request->name;
            $logo->save();
        }
        catch(Exception $e)
        {
            $errorText = "Unexpected error has occured: ".$e->getMessage();
            return redirect()->back()->with('customErrors', [$errorText])->withInput();
        }
        
        $savedMessage = "Logo has been updated"; 
        return redirect('/admin/logos/'.$logo->id.'/edit')->with('customMessages', [$savedMessage]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $logo = \App\Logo::find($id);
        
        if(isset($logo))
        {
            if(!$logo->inUse())
            {
                $this->deleteLogo($logo, $this->logoDirectory);
            }
            else
            {
                $errorText = "Unable to delete logo, as it is currently in use";
                return redirect()->back()->with('customErrors', [$errorText])->withInput();
            }
        }
        else
        {
            return redirect()->back();
        }
        
        return redirect($this->menuURL);
    }
}
