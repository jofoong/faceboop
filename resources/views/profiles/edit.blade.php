@extends("layouts.app")

@section('title', 'Edit Profile Image')
@section('content')
<div class="container-fluid">
    @auth
        <form method="POST" action="{{route('profile.update', ['profile'=>$profile])}}" enctype="multipart/form-data">
            <div class="row">
                <div class="col-4">
                        @csrf
                        <label for="image" class="sr-only"></label>
                        <img src="/images/default_profile_pic.png" alt="dog shape" width="150" height="150">
                        <div class="col-md-6">
                            <input type="file" name="image" id="image" aria-required="false">
                        </div>
                </div>
                <div class="col-8">
                    <p>Username: {{$profile->user->name}}</p>
                    <p>Breed: {{$profile->breed}}</p>
                    <div class="form-group">
                        <label class="sr-only" style="visibility:hidden" id="location"></label>
                        <p>Location: </p>
                        <textarea class="form-control" name="location" value="{{ old('location') }}" id="location" rows="3" aria-required="true">{{ $profile->location }}</textarea>            
                    </div>
                    
                    <div class="form-group">
                        <label class="sr-only" style="visibility:hidden" id="bio" ></label>
                        <p>Bio:</p>
                        <textarea class="form-control" name="bio" value="{{old('bio')}}" id="bio" rows="3" aria-required="true">{{ $profile->bio }}</textarea>            
                    </div>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
                
            </div> 
        </form>
    @endauth
</div>
@endsection