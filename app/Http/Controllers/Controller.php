<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function getLogoInfo()
    {
        return \App\Logo::all('id', 'name', 'url');
    }
    
    public function recordNotFoundRedirect($backUrl)
    {
        $errorText = "The requested record was not found";
        return redirect($backUrl)->with('customErrors', [$errorText])->withInput();;
    }
}