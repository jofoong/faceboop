{{-- Shows a single post. The user can edit or delete the post.
    
TODO: 
    edit function.
    show comments.--}}

@extends("layouts.app")

@section('title', "$post->title")

@section('content')
<div class="container-fluid my-3 border p-4">
    <div class="row">
        <h3>{{$post->title}}</h3>
        <p>{{$post->content}}</p>
        <p>Posted by 
            <a href="{{route('profiles.show', ['profile_id'=>$post->user->id])}}">{{$post->user->name}}</a>
            at {{$post->created_at}}
        </p>
    </div>
    
    <div class="row">
        @php
            $comments = $post->comments;
        @endphp
        @foreach ($comments in $comment)
            <p>{{$comment->comment}}</p>
            <p>Posted by {{$comment->user()->name}}</p>
        @endforeach
    </div>

    <form method="POST" action="{{route('posts.store', ['user_id'=>Auth::user()->id])}}">
        
        {{-- 
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
            <button type="button" class="btn btn-primary">Edit</button>
        </form>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
         --}}
        <form action="{{route('posts.destroy', ['post_id'=>$post->id])}}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-light">Delete</button>
        </form>
    </form>

</div>
@endsection