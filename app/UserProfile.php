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
	
	static function store_profile($attributes){
		// dd($attributes);
		$updated_profile = DB::table('user_profiles')
				->where('id', $attributes['user_id'])
				->update (
					['title' => $attributes['title']],
					['body' => $attributes['body']]
				);
		return $updated_profile;
	}

	
}
