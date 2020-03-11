<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Apps\Content;
use App\Models\Apps\Video;

use App\Traits\Functions;

class Home extends Controller
{
	use Functions;

    public function dashboard()
    {
    	return 'user dashboard';
    }

    public function VideoUpload(Request $request)
    {
    	$valid = $this->_Validate($request,[
    				'VideoFile' 	=> 'required|file',
    				'title'			=> 'required|min:10|max:255',
    				'ctype'			=> 'required|string',
    				'quality'		=> 'required|numeric'
    			]);

    	if(!$valid['status']) return $valid;

    	$content = file_get_contents(public_path('/content/Contents.json'));
    	$content = json_decode($content,true);

    	do{
            $id = Str::random(10);
        }while(Content::where('id',$id)->exists());

    	if($request->hasFile('VideoFile'))
    	{
            $path = 'videos';
    		$file = $request->file('VideoFile');
    		$filesize = $file->getSize();
    		$filename = $id.'.'.$request->quality;
    		$exts = $content['video']['ContentType'];

    		if($request->ctype != $file->getClientOriginalExtension())
    			return ['status'=>0,'msg'=>'Media File extension not matched'];

    		$tmp = $this->StoreContent($file,$filename,$path,$exts);

    		if(!$tmp['status']) return $tmp;

    		$path = $tmp['url'];
    	}
    	if(isset($path))
    	{
    		$userid = 'user1';
    		$content = Content::Create([
					'id'			=> $id,
					'title'			=> $request->title,
					'owner'			=> $userid,
					'type'	        => 'video'
    		]);

            $video = $content->video()->create([
                    'quality'       => $request->quality,
                    'type'          => $request->ctype,
                    'size'          => $filesize
                ]);

    		if($content)

    			return ['status'=>1,'msg'=>'Added successfully'];
    	}

    	return ['status'=>0,'msg'=>'Error Occured'];
    }
}
