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
    
    
    
    public function storeUploadedFile($imageFile, $recordId, $logoDirectory)
    {
        $url = $this->generateUploadedFileUrl($recordId, $imageFile);
        $imageFile->move($logoDirectory.'/', $url);
        return $url;
    }
    
    public function deleteUploadedFile($fileUrl, $directory)
    {
        if(isset($fileUrl))
        {
            unlink(public_path($directory.'/'.$fileUrl));
        }
    }
    
    public function generateUploadedFileUrl($fileId, $imageFile)
    {
        return \str_replace(' ', '_', $imageFile->getClientOriginalName().'_'.$fileId.'.'.$imageFile->getClientOriginalExtension());
    }
}