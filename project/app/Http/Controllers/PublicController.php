<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    // The controller for all of the public facing elements of the site
    
    public function index()
    {
        //Get the models from the database
        $tools = \App\Tool::select('id', 'name', 'logo_id')->orderBy('order')->with('logo')->get();
        $projects = \App\Project::select('id', 'title', 'smallDescription', 'logo_id')
            ->orderBy('order')->with('logo')->take(3)->get();
        $cv = \App\CV::select('id', 'url', 'logo_id')->with('logo')->first();
        $subject = \App\Subject::select('name', 'profession', 'why_top', 'why_bottom', 'email', 'phone')->first();
        
		
		
        //The "github", "email" and "phone" about links are 
        //specific links with specific positions on the page,
        // therefore pass them through seperately.
        $githubLink = \App\AboutLink::where('name', 'github')
            ->select('id', 'name', 'text', 'url', 'logo_id')->with('logo')->first();
        $aboutLinks = \App\AboutLink::where('name', '<>', 'github')
            ->select('id', 'name', 'text', 'url', 'logo_id')->orderBy('order')->with('logo')->get();
        
		
		
        return view('public.index', [
            'tools' => $tools,
            'projects' => $projects,
            'cv' => $cv,
            'subject' => $subject,
            'githubLink' => $githubLink,
            'aboutLinks' => $aboutLinks
        ]);
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
        
        return view('public.project', ['project' => $project]);
    }
}