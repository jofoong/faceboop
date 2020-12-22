@extends("layouts.app")

@section('title', "$comment->comment")

@section('content')
<div class="container-fluid my-3 border p-4">
    <div class="row">
        <h3>{{$comment->post->title}}</h3>
        <p>{{$comment->post->content}}</p>
        <p>Posted by 
            <a href="{{ route('profiles.show', ['profile_id'=>$comment->post->user->id]) }}">{{$comment->post->user->name}}</a>
            at {{$comment->post->created_at}}
        </p>
    </div>

<h6>You are now viewing a single comment.</h6>    
<div class="container">
    <div class="row">
        <div class="col-sm">
            <p>{{$comment->comment}}</p>
        </div>
        <div class="col-sm">
            <p>Posted by <a href="{{ route('profiles.show', ['profile_id'=>$comment->user->id]) }}">{{$comment->user->name}}</p>
        </div>
    </div>
</div>
</div>    
@endsection