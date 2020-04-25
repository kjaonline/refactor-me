<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\UserProfile;

class UserProfileController extends Controller
{
    public function create()
    {
        return view('user.profile.create');
    }

    public function store()
    {
        request()->validate([
            'title' => 'required',
            'body'  => 'required',
        ]);

        $attributes = [];
        $attributes['user_id'] = auth()->user()->id;

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

        $attributes['title'] = \Illuminate\Support\Str::title(request()->get('title'));
        $attributes['body'] = request()->get('body');
        $profile = \App\UserProfile::create($attributes);

        return response()->redirectTo('user/profile/'.$profile->id.'/show');
    }

    public function show(UserProfile $id)
    {
        if (!$id) {
            abort('404');
        }
        return view('user.profile.show', ['profile' => $id] );
    }

    public function edit($id)
    {
        $profile = \App\UserProfile::find($id);
        if (!$profile) {
            abort('404');
        }

        return view('user.profile.edit', compact('profile'));
    }

    public function update($id)
    {
        $profile = \App\UserProfile::find($id);

        if (!$profile) {
            abort('404');
        }

        if (auth()->user()->id != $profile->user_id) {
            abort('403');
        }

        $attributes = [];
        if (request()->has('title')) {
            $attributes['title'] = request()->get('title');
        }

        if (request()->has('body')) {
            $attributes['body'] = request()->get('body');
        }

        $profile->update($attributes);

        return response()->redirectTo('/user/profile/'.$profile->id.'/show');
    }

    public function destroy($id)
    {
        \App\UserProfile::where('id', $id)->delete();

        return response()->redirectTo('home');
    }
}
