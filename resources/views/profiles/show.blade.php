@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-2">
            @if(isset($profile->image))
                <img src="/images/{{ $profile->image->image }}" alt="display picture" width="150" height="150"></img>
            @else
                <img src="/images/default_profile_pic.png" alt="default dog display picture" width="150" height="150"></img>
            @endif
        </div>
        <div class="col-10">
            <p>Username: {{$profile->user->name}}</p>
            <p>Location: {{$profile->location}}</p>
            <p>Breed: {{$profile->breed}}</p>
            <p>Bio: {{$profile->bio}}</p>
        </div>
    </div>

    <div class="row">
        @if(Auth::id() === $profile->user_id || Gate::allows('isAdmin'))
            <form method="GET" action="{{ route('profiles.edit', ['profile'=>$profile]) }}" class="form-check form-check-inline">
                @csrf
                <button type="submit" class="btn btn-primary">Edit</button>
            </form>
        @endif
    </div>
</div>    
@endsection