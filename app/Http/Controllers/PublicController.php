<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    // The controller for all of the public facing elements of the site
    
    public function index()
    {
        return view('public.index');
    }
    
    public function projectList()
    {
        $projects = \App\Project::select('id', 'title', 'smallDescription', 'logo_id')
            ->orderBy('order')->with('logo')->get();
        
        return view('public.projectList', ['projects' => $projects]);
    }
    
    public function project($id)
    {
        $project = \App\Project::with('logo')->find($id);
        
        if(is_null($project))
        {
            return view('public.projectNotFound');
        }
        
        $project->description = $this->prepareDescription($project->description);
        
        return view('public.project', ['project' => $project]);
    }
    
    
    public function prepareDescription($description)
    {
        //The description or small description may contain multiple paragraphs, so we want 
        //to preserve these, but since we'll be printing this out raw in order to do so, we 
        //need to escape any html currently in there (however, we want to preserve the 
        //formattings of <strong> and <em>).
        $description = \htmlentities($description);
        $description = str_replace("&lt;em&gt;", "<em>", $description);
        $description = str_replace("&lt;/em&gt;", "</em>", $description);
        $description = str_replace("&lt;strong&gt;", "<strong>", $description);
        $description = str_replace("&lt;/strong&gt;", "</strong>", $description);
        $description = str_replace("\n", "<br/>", $description);
        
        return $description;
    }
}