<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Apps\Content;
use App\Models\Apps\Video;
use App\Models\Apps\Audio;

use App\Traits\Functions;

use getID3;

class Home extends Controller
{
	use Functions;

    public function dashboard()
    {
    	return 'user dashboard';
    }

    public function CreateContent(Request $request,array $vrules,string $type)
    {
        $userid = 'user1';

        $basic_rules = [
                        'ContentFile'   => 'required|file',
                        'title'         => 'required|min:10|max:255',
                        'ctype'         => 'required|string'
                    ];

        $valid = $this->_Validate($request,array_merge($basic_rules,$vrules));

        if(!$valid['status']) return $valid;

        $content = file_get_contents(public_path('/content/Contents.json'));
        $content = json_decode($content,true);

        do{
            $id = Str::random(10);
        }while(Content::where('id',$id)->exists());

        if($request->hasFile('ContentFile'))
        {
            $path = $type.'s';
            $file = $request->file('ContentFile');
            $filename = $id.(isset($request->quality)?'.'.$request->quality:''); //////
            $exts = $content[$type]['ContentType'];

            if($request->ctype != $file->getClientOriginalExtension())
                return ['status'=>0,'msg'=>'Content File extension not matched'];

            $tmp = $this->StoreContent($file,$filename,$path,$exts);

            if(!$tmp['status']) return $tmp;

            $path = $tmp['url'];
        }
        if(isset($path))
        {
            $content = Content::Create([
                    'id'    => $id,
                    'title' => $request->title,
                    'owner' => $userid,
                    'type'  => $type
            ]);

            if($content)
            {
                $content->path = $path;
                return $content;
            }
        }

        return NULL;

    }

    public function VideoUpload(Request $request)
    {
        $rules = ['quality'=>'numeric'];

        $content = $this->CreateContent($request,$rules,'video');

        if(!isset($content['id']))
        {
            return $content;
        }

        $video = Video::create([
                    'id'        => $content->id,
                    'quality'   => $request->quality,
                    'type'      => $request->ctype,
                    'size'      => $request->file('ContentFile')->getSize()
                ]);

        if(!$video)
        {
            $content->delete();
            return ['status'=>0,'msg'=>'Error Occured'];
        } 

        return ['status'=>1,'msg'=>'Added successfully'];
    }

    public function AudioUpload(Request $request)
    {
        $rules = ['artist'=>'nullable|min:3','album'=>'nullable|min:3','year'=>'nullable|numeric|min:1800|max:'.date("Y")];

        $content = $this->CreateContent($request,$rules,'audio');

        if(!isset($content['id']))
        {
            return $content;
        }

        $info = ((new getID3)->analyze(public_path('content/'.$content->path)));

        $duration = isset($info['playtime_seconds'])?$info['playtime_seconds']:0;

        $request->request->add([
                'duration'=>(int)$duration,
                'type'=>$request->ctype,
                'size'=>$request->file('ContentFile')->getSize()
            ]);

        /*$content->delete();

        return $request;*/

        $audio = $content->audio()->create($request->except(['title']));

        if(!$audio)
        {
            $content->delete();
            return ['status'=>0,'msg'=>'Error Occured'];
        } 

        return ['status'=>1,'msg'=>'Added successfully'];
    }


}
