<?php

namespace App\Http\Controllers\Apps\MusicPlayer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Apps\Content;
use Illuminate\Support\Carbon;

use App\Traits\Functions;

class Home extends Controller
{
	use Functions;

	public function fetch(Request $request)
	{
		if(!$request->has('id') || $request->id=='') $request->id = 'abcdefghik';

		$content = Content::where('id',$request->id)->first();

		if(!$content) return ['status'=>0,'msg'=>'invalid music id'];

		$content->views = $content->views + 1;
		$content->save(); //save increased view

		$audio = $content->audio;
		$audiopath = '/content/audios/'.$content->id.'.'.$audio->type;

		$lyrics = $audio->lyrics;

		if(!$lyrics)
		{
			$lyrics = ['id'=>'default','lang'=>'en','type'=>'vtt','lable'=>'English'];
			$lyrics = (object) $lyrics;
		}

		$lyricspath = '/content/captions/'.$lyrics->id.'.'.$lyrics->lang.'.'.$lyrics->type;
		
		$music = [
					'source' => [
							'src'	=> $audiopath,
							'type'	=> 'audio/'.$audio->type
					],
					'track' => [
							'src'		=> $lyricspath,
							'srclang'	=> $lyrics->lang,
							'label'		=> $lyrics->lable
					]
			];

		return ['status'=>1,'data'=>$music];

	}

	public function fetch_all_meta(Request $request)
	{
		$columns = ['title','duration','uploaded_at','Options'];

		$limit = $request->length;
        $start = $request->start;
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $totalData = Content::where(['type'=>'audio'])->count();

        if(empty($request->input('search.value')))
        {            
            $contents = Content::where(['type'=>'audio'])
            				->with('audio:id,artist,album,year,duration');

            $contents = $contents->limit($limit)->orderBy($order,$dir)
                        	->get(['id','title','owner','uploaded_at']);

            $totalFiltered = $contents->count();

            // return $contents->toArray();
        }
        else {
            $searchText = $request->input('search.value');

    		$contents = Content::where(['type'=>'audio'])
    				->with('audio:id,artist,album,year,duration')
    				->where(function($query) use ($searchText){
    					$query->where('title','like','%'.$searchText.'%')
    						->orWhere('uploaded_at','like','%'.$searchText.'%');
    				})
			    	->orWhereHas('audio',function($query) use ($searchText){

		    			$query->where('artist','LIKE','%'.$searchText.'%')
							->orWhere('album','LIKE','%'.$searchText.'%')
							->orWhere('year','LIKE','%'.$searchText.'%')
							->orWhere('duration','LIKE','%'.$searchText.'%');
			    	});
					//;

			$totalFiltered = $contents->count();

			$contents = $contents->limit($limit)
						->orderBy($order,$dir)
						->get(['id','title','owner','uploaded_at']);

		    // return $totalFiltered;//$contents->toArray();
		}

		// print_r($contents->toArray()); return;

		$data = [];

        foreach ($contents as $content)
        {
            $options = "<i class='fas fa-lg fac fa-play-circle pointer' title='play' onclick=play(`".$content->id."`)></i> <i class='fas fa-lg fac fa-info-circle pointer' title='artist: ".$content->audio->artist."&#xA;album: ".$content->audio->album."&#xA;year: ".$content->audio->year."'></i> <i class='fas fa-lg fac fa-arrow-alt-circle-down pointer' title='download' onclick=download(`".$content->id."`)></i>";

            $data[] = [
            	'id'			=> $content->id,
            	'Title' 		=> $content->title,
            	'Duration'		=> $this->SecsToHMS($content->audio->duration),
            	'Upload Time'	=> $content->uploaded_at->diffForHumans(),
            	'Options'		=> $options
            ];

        }

        $result = [
                    'draw'            => intval($request->input('draw')),  
                    'recordsTotal'    => intval($totalData),  
                    'recordsFiltered' => intval($totalFiltered), 
                    'data'            => $data   
                ];


		return $result;//['status'=>1,'data'=>$result];
	}
}
