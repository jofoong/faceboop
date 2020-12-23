@extends("layouts.app")

@section('title', 'Home')

@section('content')
<div class="container-fluid my-3 border">
    @foreach($posts as $post)
        <div class="container pt-4 p-4">
            <div class="row">
                <h3><a href="{{route('posts.show', ['post'=>$post])}}">{{$post->title}}</a></h3>
                <p>{{$post->content}}</p>  
            </div>
            <div class="row">
                <div class="col-10">
                    Posted by <a href="{{route('profiles.show', ['profile_id'=>$post->user->id])}}">{{$post->user->name}}</a> at {{$post->created_at}}
                </div>
                <div class="col-2">
                    @if (! ($post->edited === null))
                    <i>{{ $post->edited }}</i>
                    @endif
                </div>
            </div>
            
            <a type="button" class="btn btn-light" href="{{ route('posts.show', ['post'=>$post]) }}">
                Comments ({{$post->comments->count()}})
            </a>

            {{-- Only show edit and delete buttons on a post if user was poster --}}
            @unless(! (Auth::id() == $post->user_id))
                <a type="button" class="btn btn-primary" href="{{ route('posts.edit', ['post'=>$post, 'user_id'=>Auth::id()]) }}">
                    Edit
                </a>

                <form method="POST" action="{{ route('posts.destroy', ['post'=>$post, 'user'=>Auth::user()]) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete post</button>
                </form>
            @endunless
        </div>
    @endforeach
</div>
@endsection