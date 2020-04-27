@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">User Profile</div>

                <div class="card-body">
					<div class="col-md-12">
						{{ auth()->user()->name }}'s Profile:
					</div>
					<img class="img-thumbnail" src="{{ Storage::url($profile->profile_photo) }}" alt="">
                    Title: {{ $profile->title }}<br>
					Body: {{ $profile->body }}<br><br>
					@if(Auth::user()->id  )
						<a href="/user/profile/{{ $profile->id }}/edit">Edit Profile</a>
					@endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
