<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\GdriveCloudDisk;
use Illuminate\Support\Facades\Storage;

class Test extends Controller
{
	use GdriveCloudDisk;

	public function test(Request $request)
	{
		// echo $this->put();
		$disk = $this->gdrive;

		//upload on gdrive 
			$file = $request->file('file');
			$fhandle = fopen($file->getPathName(),'r+');//client file upload
			// $fhandle = fopen('/path/to/file','r+'); //local file upload
			$path = 'images';
			$name = 'test.'.$file->getClientOriginalExtension();
			$x = $this->clientupload($fhandle,$path,$name); // return drive file obj
			print_r($x);
		


		return; 



		// return $this->streamtoclient();

		/*$dir = '/1zorOQiG1hOhr2IQ2ipov3weCNbqyq_GF/';
    	$recursive = true; // Get subdirectories also?
    	$contents = collect($disk->listContents($dir, $recursive));

    	print_r($contents);*/

		/*$dir = '/';
    	$recursive = false; // Get subdirectories also?
    	$contents = collect($disk->listContents($dir, $recursive));

    	$dir = $contents->where('type','=','dir')->where('filename','=','content')->first(); // There could be duplicate directory names!
        print_r($dir);*/
	}
}
