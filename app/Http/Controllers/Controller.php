<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function recordNotFoundRedirect($backUrl)
    {
        $errorText = "The requested record was not found";
        return redirect($backUrl)->with('customErrors', [$errorText])->withInput();;
    }
    
    public function getLogoInfo()
    {
        return \App\Logo::all('id', 'name', 'url');
    }
    
    
    
    public function storeUploadedFile($file, $recordId, $directory)
    {
        $url = $this->generateUploadedFileUrl($recordId, $file);
        $file->move($directory.'/', $url);
        return $url;
    }
    
    public function deleteUploadedFile($fileUrl, $directory)
    {
        if(isset($fileUrl))
        {
            unlink(public_path($directory.'/'.$fileUrl));
        }
    }
    
    public function generateUploadedFileUrl($fileId, $file)
    {
        return \str_replace(' ', '_', $file->getClientOriginalName().'_'.$fileId.'.'.$file->getClientOriginalExtension());
    }
}