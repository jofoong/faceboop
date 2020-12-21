//TODO: fix comment collapse
//wow, thanks php, really commented out that one

@extends("layouts.app")

@section('content')
<div class="container-fluid my-3 border">
    @foreach($posts as $post)
        <div class="container pt-4">
            <div class="row">
                <h3>{{$post->title}}</h3>
                <p>{{$post->content}}</p>
                <p>
                    Posted by 
                    <a href="{{route('profiles.show', ['profile_id'=>$post->user->id])}}">{{$post->user->name}}</a>
                    at {{$post->created_at}}</p>
                </p>   
            </div>
            
            <div class="row">
                <p>
                    <button class="btn btn-light" type="button" data-toggle="collapse" data-target="#commentCollapse" aria-expanded="false" aria-controls="commentCollapse">
                    Comments ({{$post->comments->count()}})
                    </button>
                </p>
                <div class="collapse" id="commentCollapse">
                    test
                    
                    /*<?php $curr = $post->comments?>
                    @foreach($curr as $comment)
                        <p>{{$comment->comment}}</p>
                        <p>Posted by {{$comment->id}}</p>
                    @endforeach*/
                    
                </div>
            </div>
            
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