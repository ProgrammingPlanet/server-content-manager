<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Illuminate\Support\Facades\Storage;

use App\Traits\Functions;

class CDN extends Controller
{
	use Functions;

	private $disk;

	function __construct()
	{
		$this->disk = Storage::disk('content');
	}

	public function binresponse($fileabspath,$headers)
	{
		$response = new BinaryFileResponse($fileabspath,200,$headers);
        BinaryFileResponse::trustXSendfileTypeHeader(); 
        return $response;
	}

    public function serveurl($dir,$filename,$token)
    {
    	$abspath = $this->disk->path("$dir/$filename");

    	if(file_exists($abspath))
    	{
    		if($this->validatetoken($token))
    		{
                $headers = [];
                if(pathinfo($abspath,PATHINFO_EXTENSION)=='vtt')
                    $headers['Content-Type'] = 'text/vtt';

    			return $this->binresponse($abspath,$headers);
    		}
    		else{
    			return response('url expired.',410);
    		}
    	}
    	else{
    		return response('bad url.',404);
    	}
    }

}
    	
