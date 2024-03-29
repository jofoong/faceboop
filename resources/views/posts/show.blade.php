@php
    use App\Models\Profile;
@endphp
@extends("layouts.app")
@section('title', "$post->title")

@section('content')
<div class="container-fluid my-3 border p-4">
    <div class="row">
        <h3>{{ $post->title }}</h3>
        <p>{{ $post->content }}</p>
    </div>
    <div>
        @if (isset($post->image))
            <img src="/images/{{ $post->image->image }}" width="350" height="350">        
        @endif
    </div>
    <div class="row">
        <p> 
            @if ($post::has('tags','>',0))
                Tags: 
                @foreach ($post->tags as $tag)
                    <a class="btn btn-outline-dark" href="{{route('tags.index', ['tag'=>$tag])}}" role="button">{{ $tag->tag }}</a>
                @endforeach
            @endif
        </p>
    </div>
    <div class="row">
        <div class="col-8">
            Posted by <a href="{{ route('profiles.show', ['profile'=>$post->user->profile]) }}">{{$post->user->name}}</a> at {{$post->created_at}}
        </div>
        <div class="col-4">
            @if (! ($post->edited === null))
                <i>{{ $post->edited }}</i>
            @endif
        </div>
    </div>

    {{-- Only allow logged-in users to comment --}}
    @if (Auth::check())
        <div class="row">
            <form method="POST" action="{{ route('comments.store', ['user_id'=>Auth::id(), 'post_id'=>$post->id]) }}">
                @csrf
                <div class="form-group">
                    <label class="sr-only" style="visibility:hidden" id="comment">Comment</label>
                    <textarea class="form-control" name="comment" value="{{ old('comment') }}" id="comment" rows="3" placeholder="Type comment..." aria-required="true"></textarea>            
                </div>
                <button type="submit" class="btn btn-outline-success my-2 my-sm-0">Comment</button>
            </form>
        </div>
    @endif

    {{------ Displays all comments for the post ------}}
    <div class="container-fluid my-3 border p-4">
        <h5>Comments ({{$post->comments->count()}})</h5>
        @foreach ($post->comments->all() as $comment)
            <div class="row">
                <div class="col-3">
                    <a class="dark-text text-dark" href="{{ route('comments.show', ['comment'=>$comment]) }}">
                        {{$comment->comment}}
                    </a>
                </div>
                <div class="col-3">
                    Posted by <a href="{{ route('profiles.show', ['profile'=>$comment->user->profile]) }}">{{$comment->user->name}}</a>
                </div>

                <div class="col-3">
                    @if (! ($comment->edited === null))
                        <i>{{ $comment->edited }}</i>
                    @endif
                </div>
                {{-- If original commenter, show edit and delete buttons --}}
                <div class="col-3">
                    @if(Auth::id() == $comment->user_id || Gate::allows('isAdmin'))
                        <form method="GET" action="{{ route('comments.show', ['comment'=>$comment, 'user'=>Auth::user()]) }}" class="form-check form-check-inline">
                            @csrf
                            <button type="submit" class="btn btn-primary">Edit</button>
                        </form>

                        <form method="POST" action="{{ route('comments.destroy', ['comment'=>$comment, 'user'=>Auth::user()]) }}" class="form-check form-check-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    {{-- Only show the post edit/delete button if user is authorised to do so --}}
    @if(Auth::id() == $post->user_id || Gate::allows('isAdmin'))
        <form method="GET" action="{{ route('posts.edit', ['post'=>$post, 'user'=>Auth::user()]) }}" class="form-check form-check-inline"
            @csrf
            <button type="submit" class="btn btn-primary">Edit</button>
        </form>
        <form method="POST" action="{{ route('posts.destroy', ['post'=>$post, 'user'=>Auth::user()]) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete post</button>
        </form>
    @endif
</div>
@endsection