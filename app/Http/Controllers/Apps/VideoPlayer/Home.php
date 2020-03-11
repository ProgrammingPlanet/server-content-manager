<?php

namespace App\Http\Controllers\Apps\VideoPlayer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Apps\Content;
use Illuminate\Support\Carbon;


class Home extends Controller
{
	public function fetch(Request $request)
	{
		if(!$request->has('id') || $request->id=='') $request->id = 'abcdefghij';

		$content = Content::where('id',$request->id)->first();

		if(!$content) return ['status'=>0,'msg'=>'invalid media id'];

		$sources = [];
		$tracks = [];
		$thumbnail = $request->id.'.jpg';

		foreach($content->video as $video)
		{
			$path = '/content/videos/'.$content->id.'.'.$video->quality.'.'.$video->type;
			$sources[] = [
							'src'=> $path,
							'type'=> 'video/'.$video->type,
	                		'size'=> $video->quality
					];
		}

		$content->views = $content->views + 1;
		$content->save(); //save increased view

		foreach($content->video->first()->caption as $caption)
		{
			$capt = $caption->id.'.'.$caption->lang.'.'.$caption->type;
			$tracks[] = [
							'src'	=> '/content/captions/'.$capt,
							'kind'	=> 'captions',
							'srclang'=> $caption->lang,
			                'label'	=> $caption->lable
					];
		}

		if(!file_exists(public_path('/content/thumbnails/').$thumbnail))
		{
			$thumbnail = '/assets/images/default-video.jpg';
		}
		else{
			$thumbnail = '/content/thumbnails/'.$content->id.'.jpg';
		}

		$Source = [
			'id' => $content->id,
	        'type'=> 'video',	//this will be same for both audio & video
	        'title'=> $content->title,
	        'poster'=> $thumbnail,
	        'sources'=> $sources,
	        'tracks'=> $tracks,
	        'views' => $content->views,
	        'uploaded_at'=> $content->uploaded_at->format('h:i A, M d Y')
	    ];

		return ['status'=>1,'data'=>$Source];
		// return $medias[0]->uploaded_at;
		// print_r($medias[0]->uploaded_at);

	}

	public function fetch_all_meta(Request $request)
	{
		$videos = Content::where(['type'=>'video'])->get(['id','title','owner','views','uploaded_at']);
		
		foreach($videos as $key => $video)
		{
			$videos[$key]['uploaded_at_ago'] = $video->uploaded_at->diffForHumans();
		}
		return ['status'=>1,'data'=>$videos];
	}
}
