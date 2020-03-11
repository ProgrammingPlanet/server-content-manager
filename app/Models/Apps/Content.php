<?php

namespace App\Models\Apps;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $table = 'Contents';
    const CREATED_AT = 'uploaded_at';
    const UPDATED_AT = null;
	public $incrementing = false;		//to avoid 0 primary key
    protected $guarded = ['uploaded_at'];

    public function video()
    {
        return $this->hasMany(Video::class,'id');
    }

    public function audio()
    {
        return $this->hasMany(Audio::class,'id');
    }
}
