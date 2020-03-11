<?php

namespace App\Models\Apps;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table = 'Videos';
    public $timestamps = false;
	public $incrementing = false;		//to avoid 0 primary key
    protected $guarded = [];

    public function info()
    {
        return $this->belongsTo(Content::class);
    }

    public function caption()
    {
        return $this->hasMany(Caption::class,'id');
    }
}
