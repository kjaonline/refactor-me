@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if($errors->any())
            <div class="alert alert-danger">
                Oh no! We found some problems with your input. Make some changes and try again.
                <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
            @endif
            <div class="card">
                <div class="card-header">Edit Profile</div>
                <div class="card-body">
                    <form action="/user/profile/{{ $profile->id }}" method="post" enctype="multipart/form-data">
                        {{ method_field('PUT') }}
						{{ csrf_field() }}
						<div class="form-group">
							<label>Upload Profile Image</label>
							<input type="file" name="photo" />
						</div>
                        <div class="form-group">
                            <label>Title:</label>
                            <input name="title" value="{{ $profile->title }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Body:</label>
                            <textarea name="body" class="form-control" rows="5">{{ $profile->body }}</textarea>
                        </div>
                        <div class="btn-group">
                            <button class="btn btn-primary">Update Profile</button>
                            <a href="/user/profile/{{ $profile->id }}/show" class="btn btn-secondary ml-2">Cancel</a>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <form action="/user/profile/{{ $profile->id }}" method="post">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button class="btn btn-danger">Delete Profile</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
