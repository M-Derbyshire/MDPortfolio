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
    
    public function project($id)
    {
        $project = \App\Project::with('logo')->find($id);
        
        if(is_null($project))
        {
            return view('public.projectNotFound');
        }
        
        //The description may contain multiple paragraphs, so we want to preserve these,
        //but since we'll be printing this out raw, we need to escape any html currently
        //in there (however, we want to preserve the basic formattings of <strong> and <em>).
        $project->description = \htmlentities($project->description);
        $project->description = str_replace("&lt;em&gt;", "<em>", $project->description);
        $project->description = str_replace("&lt;/em&gt;", "</em>", $project->description);
        $project->description = str_replace("&lt;strong&gt;", "<strong>", $project->description);
        $project->description = str_replace("&lt;/strong&gt;", "</strong>", $project->description);
        $project->description = str_replace("\n", "<br/>", $project->description);
        
        return view('public.project', ['project' => $project]);
    }
}
