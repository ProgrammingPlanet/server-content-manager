<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

trait Functions
{
	public function _Validate(Request $request, array $vRules)
	{
		$validator = Validator::make($request->all(),$vRules);

        if ($validator->fails()) {
            return ['status'=>0,'msg'=>$validator->messages()->first()];
        }

        return ['status'=>1,'msg'=>'Validations Passed!'];
	}

	public function SecsToHMS(int $secs)
	{
		return sprintf('%02d:%02d:%02d',($secs/3600),($secs/60%60),$secs%60);
	}

	public function genratetoken($len=20,$lifetime=1,$type='url')
	{
		$token = Str::random($len);
		$check = DB::table('tokens')->insert([
				'type'		=>	$type,
				'value'		=>	$token,
				'lifetime'	=>	$lifetime*86400, //days to seconds
				'created_at'=>	time()
			]);

		return $check ? $token : NULL;
	}

	public function validatetoken($value)
	{
		return DB::table('tokens')->where('value',$value)
					->whereRaw('lifetime+created_at >= '.time())
					->exists();					
	}

	public function StoreContent($file,$name,$path,$exts)
	{
		$disk = Storage::disk('content');

		$ext = $file->getClientOriginalExtension();

		if(!in_array($ext,$exts)) return ['status'=>0,'msg'=>'invalid extenstion'];

		$path = $disk->putFileAs($path,$file,$name.'.'.$ext);

		return ['status'=>1,'url'=>$path];
	}

}