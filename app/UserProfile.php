<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserProfile extends Model
{
    protected $fillable = [
		'user_id',
		'id',
        'title',
        'body',
	];
	

	
}
