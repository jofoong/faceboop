@extends("layouts.app")

@section('title', 'Edit Post')
@section('content')

<div class="container-fluid my-3 border p-4">
    <div class="row">
        <h3>{{$post->title}}</h3>
        @unless(! (Auth::id() === $post->user_id))
            <form method="POST" action="{{ route('posts.update', ['post_id'=>$post->id, 'user_id'=>Auth::id()]) }}">
                @csrf
                <div class="form-group">
                    <label class="sr-only" style="visibility:hidden" id="content" ></label>
                    <textarea class="form-control" name="content" value="{{old('content')}}" id="content" rows="3">{{ $post->content }}</textarea>            
                </div>
                <button type="submit" class="btn btn-primary">Edit</button>
            </form>

            <form method="POST" action="{{ route('posts.destroy', ['post'=>$post, 'user'=>Auth::user()]) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>        
        @endunless
    </div>
</div>
@endsection