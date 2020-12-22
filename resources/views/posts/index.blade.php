@extends("layouts.app")

@section('title', 'Home')

@section('content')
<div class="container-fluid my-3 border">
    @foreach($posts as $post)
        <div class="container pt-4 p-4">
            <div class="row">
                <h3><a href="{{route('posts.show', ['post_id'=>$post->id])}}">{{$post->title}}</a></h3>
                <p>{{$post->content}}</p>
                <p>
                    Posted by
                    <a href="{{route('profiles.show', ['profile_id'=>$post->user->id])}}">{{$post->user->name}}</a>
                    at {{$post->created_at}}
                </p>   
            </div>
            
            <button type="button" class="btn btn-light">
                <a href="{{route('posts.show', ['post_id'=>$post->id])}}">
                    Comments ({{$post->comments->count()}})
                </a>
            </button>
 
            <div class="row">
                <form>
                    <label for="comment" style="visibility:hidden">Comment</label>
                    <textarea class="form-control mb-2 mr-sm-2" id="comment" placeholder="Type comment here..."></textarea>
                    <button type="submit" class="btn btn-primary mb-2" href="#">Comment</button>
                </form>
            </div>
        </div>
    @endforeach
</div>
@endsection