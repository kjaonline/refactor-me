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
                <div class="card-header">Create Profile</div>
                <div class="card-body">
                    <form action="/user/profile" method="post" enctype="multipart/form-data">
						{{ csrf_field() }}
						<div class="form-group">
							<input type="file" name="photo" />
							<br><label>Upload Profile Image</label>
						</div>
                        <div class="form-group">
                            <label>Title:</label>
                            <input name="title" value="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Body:</label>
                            <textarea name="body" value="" class="form-control" rows="5"></textarea>
						</div>
						
                        <div class="btn-group">
                            <button class="btn btn-primary">Create Profile</button>
                            <a href="/home" class="btn btn-secondary ml-2">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
