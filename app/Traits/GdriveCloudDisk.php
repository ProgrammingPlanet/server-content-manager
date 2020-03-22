<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use League\Flysystem\Config;

trait GdriveCloudDisk
{
	protected $gdrive,$folders;

	function __construct()
	{
		$this->gdrive = Storage::disk('gdrive');
		$this->folders = [
			'audios'=>'1ulfe1m0oLaj6vhOUwAR8XkoCMiDjIg5W',
			'documents'=>'1vMnaW7d5lk5LQfZ5z0KY2Iw_HD7c0_d0',
			'captions'=>'1d97-vDq3EDt7HzJRHRj3OXIQhNjkMd0o',
			'images'=>'1ydlygp5gsteyBUC8P_yTei4PDVqAYGbl',
			'thumbnails'=>'1wlvm1pzUEEMIfY0PxJmwg_xd-AlU_Ltx',
			'videos'=>'1zorOQiG1hOhr2IQ2ipov3weCNbqyq_GF'
		];
	}
	
	public function clientupload($filehandle,$dirname,$fname)
	{
		$gdrive = $this->gdrive;
		$pathname = $this->folders[$dirname].'/';
		return $gdrive->getAdapter()->write($pathname,$filehandle,new Config([]));
		// return $request->file->storeAs('/',$fname,'gdrive');
	}

	public function stream($dirname,$fileid,$filemeta,$download=false)
	{
		$gdrive = $this->gdrive;

		$path = $this->folders[$dirname].'/'.$fileid;

		$readStream = $gdrive->getDriver()->readStream($path);

		$conf = ['Content-Type'=>$filemeta['mime']];

		if($download)
		{
			$conf += ['Content-disposition'=>'attachment;filename="'.$filemeta['name'].'"'];
		}

	    return response()->stream(
			    	function() use ($readStream){
			    		fpassthru($readStream);
			    	}, 200,$conf
			    );
	}


}