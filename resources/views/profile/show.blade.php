@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-2">
            <img src="/images/default_profile_pic.png" alt="dog shape" width="150" height="150">
        </div>
        <div class="col-10">
            <p>Username: {{$profile->user->name}}</p>
            <p>Breed: {{$profile->breed}}</p>
            <p>Bio: {{$profile->bio}}</p>
        </div>
    </div>
    @if((Auth::id() == $profile->user_id) || Gate::allows('isAdmin'))
        <form method="POST" action="{{ route('profiles.destroy', ['profile'=>$profile, 'user'=>Auth::user()]) }}" class="form-check form-check-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    @endif
</div>    
@endsection