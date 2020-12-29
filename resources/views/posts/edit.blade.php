@php
  use App\Models\Tag;
@endphp

@extends("layouts.app")

@section('title', 'Edit Post')
@section('content')

<div class="container-fluid my-3 border p-4">
  @auth
        <div class="row">
            <form method="POST" action="{{ route('posts.update', ['post_id'=>$post->id, 'user_id'=>Auth::id()]) }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label id="title" >Title</label>
                    <textarea class="form-control" name="title" value="{{ old('title') }}" id="title" rows="1" aria-required="true">{{ $post->title }}</textarea>
                </div>
                <div class="form-group">
                  <label id="content" >Post</label>
                  <textarea class="form-control" name="content" value="{{old('content')}}" id="content" rows="3" aria-required="true">{{ $post->content }}</textarea>            
                </div>
                <div class="form-group">
                  <label for="image">Image</label>
                  <div class="col-md-6">
                      <input type="file" name="image" id="image" aria-required="false">
                      </input>
                  </div>
                </div>

                <div class="form-check form-check-inline">
                    Tags: 
                      @foreach (Tag::get()->unique() as $tag)
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" name="{{ $tag->tag }}" type="checkbox" id="{{ $tag->tag }}" value="{{ $tag->tag }}" aria-required="false">
                          <label class="form-check-label" for="{{ $tag->tag }}">{{ $tag->tag }}</label>
                        </div>
                      @endforeach
                </div>
                <div>
                  <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </form>    

            <form method="POST" action="{{ route('posts.destroy', ['post'=>$post, 'user'=>Auth::user()]) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
  @endauth
</div>
@endsection