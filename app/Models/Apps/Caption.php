<?php

namespace App\Models\Apps;

use Illuminate\Database\Eloquent\Model;

class Caption extends Model
{
    protected $table = 'Captions';
    public $timestamps = false;
	public $incrementing = false;		//to avoid 0 primary key
    protected $guarded = [];
}
