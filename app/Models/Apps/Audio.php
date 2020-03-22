<?php

namespace App\Models\Apps;

use Illuminate\Database\Eloquent\Model;

class Audio extends Model
{
    protected $table = 'Audios';
    public $timestamps = false;
	public $incrementing = false;		//to avoid 0 primary key
    protected $fillable = ['id','artist','album','year','type','duration','size'];

    protected $attributes = ['artist'=>'unknown','album'=>'unknown','year'=>'unknown']; //default column values

    public function info()
    {
        return $this->belongsTo(Content::class);
    }

    public function lyrics()
    {
        return $this->hasOne(Caption::class,'id');
    }
}
