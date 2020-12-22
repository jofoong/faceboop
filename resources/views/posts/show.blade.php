{{-- Shows a single post. The user can edit or delete the post,
    or comment on it.
    
TODO: 
    edit function.--}}

@extends("layouts.app")

@section('title', "$post->title")

@section('content')
<div class="container-fluid my-3 border p-4">
    <div class="row">
        <h3>{{$post->title}}</h3>
        <p>{{$post->content}}</p>
        <p>Posted by 
            <a href="{{ route('profiles.show', ['profile_id'=>$post->user->id]) }}">{{$post->user->name}}</a>
            at {{$post->created_at}}
        </p>
    </div>
    
    {{------ Post comments here 
    <div class="row">
        <form class="form-inline my-2 my-lg-0">
            <button class="btn btn-outline-success my-2 my-sm-0">
                {{$post->id}}
                <a href="{{ route('comments.store', ['user_id'=>Auth::user()->id,'post_id'=>$post->id]) }}">
                   Comment 
                </a>
            </button>
        </form>
    </div>------}}

    {{------ Displays all comments for the post ------}}
    <div class="container">
        <h5>Comments ({{$post->comments->count()}})</h5>
        @foreach ($post->comments->all() as $comment)
            <div class="row">
                <div class="col-sm">
                    <a href="{{ route('comments.show', ['comment'=>$comment]) }}">
                        <p>{{$comment->comment}}</p>
                    </a>
                </div>
                <div class="col-sm">
                    <p>Posted by <a href="{{ route('profiles.show', ['profile_id'=>$comment->user->id]) }}">{{$comment->user->name}}</a></p>
                </div>
            </div>   
        @endforeach
    </div>

    {{-- 
    
    <form method="POST" action="{{route('posts.store', ['user_id'=>Auth::user()->id])}}">
        @csrf


        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" name="title" value="{{old('title')}}" class="form-control" id="title">
        </div>
          
        <div class="form-group">
          <label for="content">Post</label>
          <textarea class="form-control" name="content" content="{{old('content')}}" id="content" rows="3" placeholder="Type post here..."></textarea>
        </div>

        <div>
        <form action="{{route('posts.edit', ['post_id'=>$post->id])}}" method="POST">
            <button type="submit" class="btn btn-primary">Edit</button>
        </form>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>

        
    </form>--}}
        <form action="{{route('posts.destroy', ['post_id'=>$post->id])}}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-light">Delete</button>
        </form>

</div>
@endsection