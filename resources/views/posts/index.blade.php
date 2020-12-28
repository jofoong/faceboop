@php
    use App\Models\Profile;
@endphp

@extends("layouts.app")

@section('title', 'Home')

@section('content')
<div class="container-fluid my-3 border">
    @foreach($posts as $post)
        <div class="container pt-4 p-4">
            <div class="row">
                <h3><a href="{{route('posts.show', ['post'=>$post])}}">{{$post->title}}</a></h3>
                <p>{{$post->content}}</p> 
                <div>
                    @if (isset($post->image))
                        <img src="/images/{{ $post->image->image }}" width="350" height="350">        
                    @endif
                </div>
                <p> 
                    @if ($post::has('tags','>',0))
                        Tags: 
                        @foreach ($post->tags as $tag)
                            <a class="btn btn-outline-dark" href="{{ route('tags.index', ['tag'=>$tag]) }}" role="button">{{ $tag->tag }}</a>
                        @endforeach
                    @endif
                </p> 
            </div>
            <div class="row">
                <div class="col-8">
                    Posted by <a href="{{route('profiles.show', ['profile'=>$post->user->profile])}}">{{$post->user->name}}</a> at {{$post->created_at}}
                </div>
                <div class="col-4">
                    @if (! ($post->edited === null))
                    <i>{{ $post->edited }}</i>
                    @endif
                </div>
            </div>
            
            <a type="button" class="btn btn-light" href="{{ route('posts.show', ['post'=>$post]) }}">
                Comments ({{$post->comments->count()}})
            </a>

            {{-- Only show edit and delete buttons on a post if user was poster --}}
            @if(Auth::id() == $post->user_id || Gate::allows('isAdmin'))
                <div class="row">
                
                    <form method="GET" action="{{ route('posts.edit', ['post'=>$post, 'user'=>Auth::user()]) }}" class="form-check form-check-inline">
                        @csrf
                        <button type="submit" class="btn btn-primary">Edit post</button>
                    </form> 
                    <form method="POST" action="{{ route('posts.destroy', ['post'=>$post, 'user'=>Auth::user()]) }}" class="form-check form-check-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete post</button>
                    </form>
                
                </div>
            @endif
        </div>
    @endforeach
</div>
<div class="d-flex justify-content-center">
    {{ $posts->links() }}
</div>
@endsection