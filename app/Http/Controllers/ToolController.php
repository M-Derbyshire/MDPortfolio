<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ToolController extends Controller
{
    protected $menuURL = "/admin/tools/";
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function validator($request)
    {
        $request->validate([
            'name' => 'required',
            'selectedLogoID' => 'required|exists:logos,id',
            'order' => 'numeric'
        ]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tools = \App\Tool::orderBy('order')->get();
        $menuItems = [];
        
        foreach($tools as $tool)
        {
            array_push($menuItems, [ 'name' => $tool->name, 'url' => '/admin/tools/'.$tool->id.'/edit' ]);
        }
        
        $constantItems = [
            [ 'name' => 'Create Tool', 'url' => '/admin/tools/create' ]
        ];
        
        $allMenuItems = array_merge($constantItems, $menuItems);
        
        return view('admin.menu', [
            'pageTitle' => 'Tools',
            'title' => 'Tools',
            'subtitle' => 'The tools (languages and technologies) you can use',
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
        
        return view('admin.tools.edit', ['menuURL' => $this->menuURL, 'logos' => $logos]);
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
            $tool = \App\Tool::create([
                'name' => $request->name,
                'logo_id' => $request->selectedLogoID,
                'order' => $request->order
            ]);
        }
        catch(Exception $e)
        {
            $errorText = "Unexpected error has occured: ".$e->getMessage();
            return redirect()->back()->with('customErrors', [$errorText])->withInput();
        }
        
        return redirect('/admin/tools/'.$tool->id.'/edit');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('/admin/tools/'.$id.'/edit');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tool = \App\Tool::find($id);
        $logos = $this->getLogoInfo();
        
        if(is_null($tool))
        {
            return $this->recordNotFoundRedirect('/admin/tools/create');
        }
        
        return view('admin.tools.edit', [
            'menuURL' => $this->menuURL, 
            'deleteURL' => '/admin/tools/'.$tool->id,
            'logos' => $logos,
            'id' => $id,
            'toolName' => $tool->name,
            'currentLogoId' => $tool->logo_id,
            'order' => $tool->order
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
            $tool = \App\Tool::find($id);
            
            if(is_null($tool))
            {
                return redirect()->back();
            }
            
            $tool->name = $request->name;
            $tool->logo_id = $request->selectedLogoID;
            $tool->order = $request->order;
            $tool->save();
        }
        catch(Exception $e)
        {
            $errorText = "Unexpected error has occured: ".$e->getMessage();
            return redirect()->back()->with('customErrors', [$errorText])->withInput();
        }
        
        return redirect('/admin/tools/'.$tool->id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tool = \App\Tool::find($id);
        
        if(isset($tool))
        {
            $tool->delete();
        }
        else
        {
            return redirect()->back();
        }
        
        return redirect($this->menuURL);
    }
}
