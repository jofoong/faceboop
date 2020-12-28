@extends("layouts.app")

@section('title', 'Edit Profile Image')
@section('content')
<div class="container-fluid">
    @auth
        <div class="row">
            <div class="col-4">
                <form method="POST" action="{{route('profile.update', ['profile'=>$profile])}}" enctype="multipart/form-data">
                    @csrf
                    <label for="image">Image</label>
                    <img src="/images/default_profile_pic.png" alt="dog shape" width="150" height="150">
                    <div class="col-md-6">
                        <input type="file" name="image" id="image">
                    </div>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </form>

            </div>
            <div class="col-8">
                <p>Username: {{$profile->user->name}}</p>
                <p>Location: {{$profile->location}}</p>
                <p>Breed: {{$profile->breed}}</p>
                <p>Bio: {{$profile->bio}}</p>
            </div>
        </div> 
    @endauth
</div>
@endsection