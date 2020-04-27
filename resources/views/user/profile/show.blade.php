@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">User Profile</div>

                <div class="card-body">
					
					<div class="card" style="width: 18rem">
						<div class="col-md-12">
							{{ $name->name }}'s Profile:
						</div>
						@if (!$profile->profile_photo == '/storage/none.jpg')
							<img src="{{ Storage::url($profile->profile_photo) }}" alt="">
						@else
							<img src="https://pngimage.net/wp-content/uploads/2018/06/generic-person-png-4.png" alt="">
						@endif
						<div class="card-body">
							<h3 class="card-title">{{ $profile->title }}</h3>
							<div class="card-text">{{ $profile->body }}</div>
							@if(Auth::user()->id  )
								<a href="/user/profile/{{ $profile->id }}/edit" class="btn btn-primary">Edit Profile</a>
							@endif
						</div>
					</div>

					
					
					
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
