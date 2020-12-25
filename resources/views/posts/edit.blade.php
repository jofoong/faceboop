@php
  use App\Models\Tag;
@endphp

@extends("layouts.app")

@section('title', 'Edit Post')
@section('content')

<div class="container-fluid my-3 border p-4">
        <div class="row">
            <form method="POST" action="{{ route('posts.update', ['post_id'=>$post->id, 'user_id'=>Auth::id()]) }}">
                @csrf
                <div class="form-group">
                    <label id="title" >Title</label>
                    <input type="text" name="title" value="{{old('title')}}" class="form-control" id="title" placeholder="{{ $post->title }}">
                </div>

                <div class="form-group">
                    <label class="sr-only" style="visibility:hidden" id="content" ></label>
                    <textarea class="form-control" name="content" value="{{old('content')}}" id="content" rows="3">{{ $post->content }}</textarea>            
                </div>

                <div class="form-check form-check-inline">
                    Tags: 
                      @foreach (Tag::get()->unique() as $tag)
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" name="{{ $tag->tag }}" type="checkbox" id="{{ $tag->tag }}" value="{{ $tag->tag }}">
                          <label class="form-check-label" for="{{ $tag->tag }}">{{ $tag->tag }}</label>
                        </div>
                      @endforeach
                  </div>
                <button type="submit" class="btn btn-primary">Edit</button>
            </form>    

            <form method="POST" action="{{ route('posts.destroy', ['post'=>$post, 'user'=>Auth::user()]) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
</div>
@endsection