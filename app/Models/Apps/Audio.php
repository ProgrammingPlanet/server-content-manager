<?php

namespace App\Models\Apps;

use Illuminate\Database\Eloquent\Model;

class Audio extends Model
{
    protected $table = 'Videos';
    public $timestamps = false;
	public $incrementing = false;		//to avoid 0 primary key
    protected $guarded = [];

    public function info()
    {
        return $this->belongsTo(Content::class);
    }

    public function lyrics()
    {
        return $this->hasMany(Caption::class,'id');
    }
}
