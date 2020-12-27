@extends("layouts.app")

@section('title', "$comment->comment")

@section('content')
<div class="container-fluid my-3 border p-4">
    <div class="row">
        <h3>{{$comment->post->title}}</h3>
        <p>{{$comment->post->content}}</p>
        <div>
            @if (! $comment->post->image == null)
                <img src="{{ $comment->post->image->image }}" width="350" height="350">        
            @endif
        </div>
        <p> 
            @if ($comment->post::has('tags','>',0))
                Tags: 
                @foreach ($comment->post->tags as $tag)
                    <a class="btn btn-outline-dark" href="{{route('tags.index', ['tag'=>$tag])}}" role="button">{{ $tag->tag }}</a>
                @endforeach
            @endif
        </p> 
        <p>Posted by 
            <a href="{{ route('profiles.show', ['profile_id'=>$comment->post->user->id]) }}">{{$comment->post->user->name}}</a>
            at {{$comment->post->created_at}}
        </p>
    </div>

<h6>You are now viewing a single comment.</h6>    
<div class="container-fluid my-3 border p-4">
    <div class="row">
        <div class="col-3">
            <p>{{$comment->comment}}</p>
        </div>
        <div class="col-3">
            <p>Posted by <a href="{{ route('profiles.show', ['profile_id'=>$comment->user->id]) }}">{{$comment->user->name}}</a></p>
        </div>
        <div class="col-3">
            @if (! ($comment->edited === null))
                <i>{{ $comment->edited }}</i>
            @endif
        </div>
    </div>
    <div class="row">
        {{-- Only allow admin/original commenter to edit/delete their comment--}}
        @if(Auth::id() === $comment->user_id || Gate::allows('isAdmin')) 
            @can('update-comment', $comment)
                <form method="POST" action="{{ route('comments.update', ['comment_id'=>$comment->id, 'user_id'=>Auth::id()]) }}">
                    @csrf
                    <div class="form-group">
                        <label class="sr-only" style="visibility:hidden" id="comment" >Comment</label>
                        <textarea class="form-control" name="comment" value="{{old('comment')}}" id="comment" rows="3">{{ $comment->comment }}</textarea>            
                    </div>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </form>

                <form method="POST" action="{{ route('comments.destroy', ['comment'=>$comment, 'user'=>Auth::user()]) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            @endcan
        @endif
    </div>
</div>    
@endsection