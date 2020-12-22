@extends("layouts.app")

@section('title', 'Home')

@section('content')
<div class="container-fluid my-3 border">
    @foreach($posts as $post)
        <div class="container pt-4 p-4">
            <div class="row">
                <h3><a href="{{route('posts.show', ['post'=>$post])}}">{{$post->title}}</a></h3>
                <p>{{$post->content}}</p>
                <p>
                    Posted by
                    <a href="{{route('profiles.show', ['profile_id'=>$post->user->id])}}">{{$post->user->name}}</a>
                    at {{$post->created_at}}
                </p>   
            </div>
            
            <button type="button" class="btn btn-light">
                <a href="{{route('posts.show', ['post'=>$post])}}">
                    Comments ({{$post->comments->count()}})
                </a>
            </button>
        </div>
    @endforeach
</div>
@endsection