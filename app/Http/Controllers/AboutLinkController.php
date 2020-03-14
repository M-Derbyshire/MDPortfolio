<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutLinkController extends Controller
{
    protected $menuURL = "/admin/aboutlinks/";
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function validator($request)
    {
        $request->validate([
            'name' => 'required',
            'text' => 'required',
            'url' => 'required|url',
            'selectedLogoID' => 'required|exists:logos,id'
        ]);
    }
    
    
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $links = \App\AboutLink::all();
        $menuItems = [];
        
        foreach($links as $link)
        {
            array_push($menuItems, [ 'name' => $link->name, 'url' => '/admin/aboutlinks/'.$link->id.'/edit' ]);
        }
        
        $constantItems = [
            [ 'name' => 'Create About Link', 'url' => '/admin/aboutlinks/create' ]
        ];
        
        $allMenuItems = array_merge($constantItems, $menuItems);
        
        return view('admin.menu', [
            'pageTitle' => 'About Links',
            'title' => 'About Links',
            'subtitle' => 'The links to more information about you',
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
        $logos = $this->getLogoInfo();
        
        return view('admin.aboutlinks.edit', ['menuURL' => $this->menuURL, 'logos' => $logos]);
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
            $link = \App\AboutLink::create([
                'name' => $request->name,
                'text' => $request->text,
                'url' => $request->url,
                'logo_id' => $request->selectedLogoID
            ]);
        }
        catch(Exception $e)
        {
            $errorText = "Unexpected error has occured: ".$e->getMessage();
            return redirect()->back()->with('customErrors', [$errorText])->withInput();
        }
        
        return redirect('/admin/aboutlinks/'.$link->id.'/edit');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('/admin/aboutlinks/'.$id.'/edit');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $link = \App\AboutLink::find($id);
        $logos = $this->getLogoInfo();
        
        if(is_null($link))
        {
            return $this->recordNotFoundRedirect('/admin/aboutlinks/create');
        }
        
        return view('admin.aboutlinks.edit', [
            'menuURL' => $this->menuURL, 
            'deleteURL' => '/admin/aboutlinks/'.$link->id,
            'logos' => $logos,
            'id' => $id,
            'linkName' => $link->name,
            'linkText' => $link->text,
            'linkUrl' => $link->url,
            'currentLogoId' => $link->logo_id
        ]);
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
            $link = \App\AboutLink::find($id);
            
            if(is_null($link))
            {
                return redirect()->back();
            }
            
            $link->name = $request->name;
            $link->text = $request->text;
            $link->url = $request->url;
            $link->logo_id = $request->selectedLogoID;
            $link->save();
        }
        catch(Exception $e)
        {
            $errorText = "Unexpected error has occured: ".$e->getMessage();
            return redirect()->back()->with('customErrors', [$errorText])->withInput();
        }
        
        return redirect('/admin/aboutlinks/'.$link->id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $link = \App\AboutLink::find($id);
        
        if(isset($link))
        {
            $link->delete();
        }
        else
        {
            return redirect()->back();
        }
        
        return redirect($this->menuURL);
    }
}
