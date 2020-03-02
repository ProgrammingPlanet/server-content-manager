<?php

namespace App\Models\User\Apps\MediaPlayer;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
	
    protected $table = 'Medias';
    const CREATED_AT = 'uploaded_at';
    const UPDATED_AT = null;
	public $incrementing = false;		//to avoid 0 primary key
    protected $guarded = ['id','uploaded_at'];
}
