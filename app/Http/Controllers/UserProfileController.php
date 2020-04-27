<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\UserProfile;

use Auth;
use Storage;
use File;

class UserProfileController extends Controller
{	

    public function index(UserProfile $id){
        return view('user.profile.show',['id' => $id]);
    }

    public function create()
    {
        return view('user.profile.create');
    }

    public function store(UserProfile $id)
    {
        request()->validate([
            'title' => 'required',
			'body'  => 'required',
			'photo'  => 'image|nullable|max:1999',
		]);
		
		//File Upload 
		if(request()->hasFile('photo')){
			$photo_path = Storage::putFile('public/images/photos', request()->file('photo'));

		} else {
			$photo_path = 'none.jpg';
		}

        $attributes = [];
		$attributes['user_id'] = auth()->user()->id;
		$attributes['photo'] = $photo_path;
		
        $title_too_long = false;
        $body_too_long = false;
		
        if (strlen(request()->get('title')) > 100) {
			$title_too_long = true;
        }
        if (strlen(request()->get('body')) > 280) {
			$body_too_long = true;
		}
		
        $errors = [];
        if ($title_too_long) {
			$errors['title'] = 'The Title is more than 100 characters. Try something shorter.';
        }
		
        if ($body_too_long) {
			$errors['body'] = 'The body is more than 280 characters. Try to be a bit more brief.';
        }
		
        if ($title_too_long || $body_too_long) {
			throw ValidationException::withMessages($errors);
        }
		
        $attributes['title'] = request()->get('title');
		$attributes['body']  = request()->get('body');

		$profile = new UserProfile;
		$profile->profile_photo = $attributes['photo'];
		$profile->user_id = $attributes['user_id'];
		$profile->title = $attributes['title'];
		$profile->body = $attributes['body'];
		$profile->save();
		
        return view('user.profile.show', ['profile' => $profile]);
}

    public function show(UserProfile $id)
    {
        if (!$id) {
			abort('404');
		}
        return view('user.profile.show', ['profile' => $id] );
    }

    public function edit(UserProfile $id)
    {
        if (!$id) {
            abort('404');
		}
		return view('user.profile.edit', ['profile' => $id]);
    }

    public function update(Userprofile $id)
    {
        if (!$id) {
            abort('404');
        }

        if (auth()->user()->id != $id->user_id) {
            abort('403');
        }
		//File Upload 
		if(request()->hasFile('photo')){
			$photo_path = Storage::putFile('public/images/photos', request()->file('photo'));
		} else {
			$photo_path = 'none.jpg';
		}

		$attributes = [];
		$attributes['profile_photo'] = $photo_path;
        if (request()->has('title')) {
            $attributes['title'] = request()->get('title');
        }

        if (request()->has('body')) {
            $attributes['body'] = request()->get('body');
		}
		// dd($attributes);

        $id->update($attributes);

		return view('user.profile.show', ['profile' => $id] );
    }

    public function destroy($id)
    {
        \App\UserProfile::where('id', $id)->delete();

        return response()->redirectTo('home');
    }
}
