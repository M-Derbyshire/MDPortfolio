<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
    protected $menuURL = "/admin/projects/";
    protected $fileDirectory = "uploads/files";
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function validator($request)
    {
        $request->validate([
            'title' => 'required',
            'smallDescription' => 'required',
            'description' => 'required',
            'selectedLogoID' => 'required|exists:logos,id',
            'githubUrl' => 'url'
            //Don't need any validation for the zip file (rarely, it may not be a zip)
        ]);
    }
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = \App\Project::all();
        $menuItems = [];
        
        foreach($projects as $project)
        {
            array_push($menuItems, [ 'name' => $project->title, 'url' => '/admin/projects/'.$project->id.'/edit' ]);
        }
        
        $constantItems = [
            [ 'name' => 'Create Project', 'url' => '/admin/projects/create' ]
        ];
        
        $allMenuItems = array_merge($constantItems, $menuItems);
        
        return view('admin.menu', [
            'pageTitle' => 'Projects',
            'title' => 'Projects',
            'subtitle' => 'The projects you have developed',
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
        
        return view('admin.projects.edit', ['menuURL' => $this->menuURL, 'logos' => $logos]);
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
            $project = \App\Project::create([
                'title' => $request->title,
                'smallDescription' => $request->smallDescription,
                'description' => $request->description,
                'logo_id' => $request->selectedLogoID,
                'githubUrl' => $request->githubUrl,
                'zipUrl' => '' //Will set this below
            ]);
            
            $project->zipUrl = $this->storeUploadedFile($request->zipFile, $project->id, $this->fileDirectory);
            $project->save();
        }
        catch(Exception $e)
        {
            $errorText = "Unexpected error has occured: ".$e->getMessage();
            return redirect()->back()->with('customErrors', [$errorText])->withInput();
        }
        
        return redirect('/admin/projects/'.$project->id.'/edit');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('/admin/projects/'.$id.'/edit');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = \App\Project::find($id);
        $logos = $this->getLogoInfo();
        
        if(is_null($project))
        {
            return $this->recordNotFoundRedirect('/admin/projects/create');
        }
        
        return view('admin.projects.edit', [
            'menuURL' => $this->menuURL, 
            'deleteURL' => '/admin/projects/'.$project->id,
            'logos' => $logos,
            'id' => $id,
            'projectTitle' => $project->title,
            'projectSmallDescription' => $project->smallDescription,
            'projectDescription' => $project->description,
            'currentLogoId' => $project->logo_id,
            'projectGithubUrl' => $project->githubUrl
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
            $project = \App\Project::find($id);
            
            if(is_null($project))
            {
                return redirect()->back();
            }
            
            
            if(isset($request->zipFile))
            {
                $this->deleteUploadedFile($project->zipUrl, $this->fileDirectory);
                
                $project->zipUrl = $this->storeUploadedFile($request->zipFile, $project->id, $this->fileDirectory);
            }
            
            $project->title = $request->title;
            $project->smallDescription = $request->smallDescription;
            $project->description = $request->description;
            $project->logo_id = $request->selectedLogoID;
            $project->githubUrl = $request->githubUrl;
            $project->save();
        }
        catch(Exception $e)
        {
            $errorText = "Unexpected error has occured: ".$e->getMessage();
            return redirect()->back()->with('customErrors', [$errorText])->withInput();
        }
        
        return redirect('/admin/projects/'.$project->id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = \App\Project::find($id);
        
        if(isset($project))
        {
            $this->deleteUploadedFile($project->zipUrl, $this->fileDirectory);
            $project->delete();
        }
        else
        {
            return redirect()->back();
        }
        
        return redirect($this->menuURL);
    }
}
