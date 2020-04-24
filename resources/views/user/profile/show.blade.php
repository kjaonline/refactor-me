@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">User Profile</div>

                <div class="card-body">
                    {{ auth()->user()->name }}'s Profile:<br><br>

                    Title: {{ $profile->title }}<br>
					Body: {{ $profile->body }}<br><br>
					@if($profile->id === $profile->user_id)
						<a href="/user/profile/{{ $profile->id }}/edit">Edit Profile</a>
					@endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
