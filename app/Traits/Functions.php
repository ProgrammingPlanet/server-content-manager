<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

trait Functions
{
	function _Validate(Request $request, array $vRules)
	{
		$validator = Validator::make($request->all(),$vRules);

        if ($validator->fails()) {
            return ['status'=>0,'msg'=>$validator->messages()->first()];
        }

        return ['status'=>1,'msg'=>'Validations Passed!'];
	}

	function StoreContent($file,$name,$path,$exts)
	{
		$disk = 'content';

		$ext = $file->getClientOriginalExtension();

		if(!in_array($ext,$exts)) return ['status'=>0,'msg'=>'invalid extenstion'];

		$path = Storage::disk($disk)->putFileAs($path,$file,$name.'.'.$ext);

		return ['status'=>1,'url'=>$path];
	}

}