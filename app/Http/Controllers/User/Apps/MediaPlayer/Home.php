<?php

namespace App\Http\Controllers\User\Apps\MediaPlayer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User\Apps\MediaPlayer\Media;
use App\Models\User\Apps\MediaPlayer\Caption;

class Home extends Controller
{
	public function fetchmedia(Request $request)
	{
		if(!$request->has('id') || $request->id=='') $request->id = 'abcdefghij';

		$medias = Media::where('id',$request->id)->get();

		$captions = Caption::where('id',$request->id)->get();

		if(!$medias) return ['status'=>0,'msg'=>'invalid media id'];
		if(!$captions) $captions = new Caption;

		$sources = [];
		$tracks = [];
		$thumbnail = $medias[0]->id.'.jpg';

		foreach($medias as $media)
		{
			$tmp = explode('/',$media->content_type);
			$path = '/content/'.$tmp[0].'s/'.$media->id.'.'.$media->quality.'.'.$tmp[1];
			$sources[] = [
							'src'=> $path,
							'type'=> $media->content_type,
	                		'size'=> $media->quality
					];
			$media->views = $media->views + 1;
			$media->save();
		}

		 //save increased view

		foreach($captions->toArray() as $caption)
		{
			$capt = $caption['id'].'.'.$caption['lang'].'.'.$caption['type'];
			$tracks[] = [
							'kind'	=> 'captions',
			                'label'	=> $caption['lable'],
			                'srclang'=> $caption['lang'],
			                'src'	=> '/content/captions/'.$capt
					];
		}

		if(!file_exists(public_path('/content/thumbnails/').$thumbnail))
		{
			$thumbnail = '/assets/images/default-'.$tmp[0].'.jpg';
		}
		else{
			$thumbnail = '/content/thumbnails/'.$medias[0]->id.'.jpg';
		}

		$Source = [
			'id' => $medias[0]->id,
	        'type'=> 'video',	//this will be same for both audio & video
	        'title'=> $medias[0]->title,
	        'poster'=> $thumbnail,
	        'sources'=> $sources,
	        'tracks'=> $tracks,
	        'views' => $medias[0]->views,
	        'uploaded_at'=> ($medias[0]->uploaded_at->format('h:i A, M d Y'))
	    ];

		return ['status'=>1,'data'=>$Source];
		// return $medias[0]->uploaded_at;
		// print_r($medias[0]->uploaded_at);

	}

	public function fetch_all_media_meta(Request $request)
	{
		$medias = Media::distinct('id')->get(['id','title','owner','content_type','size','uploaded_at']);
		
		if(!$medias) return ['status'=>0,'msg'=>'list is empty'];

		$results = [];

		foreach($medias as $media)
		{
			$tmp = $media->toArray();
			$tmp['uploaded_at'] = $media->uploaded_at->diffForHumans();
			$results[] = $tmp;
		}
		return ['status'=>1,'data'=>$results];
	}
}
