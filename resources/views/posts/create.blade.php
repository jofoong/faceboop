@php
  use App\Models\Tag;
@endphp

@extends("layouts.app")

@section('title', 'Create Post')

@section('content')
<div class="container-fluid my-3 border">
  @auth
    <form method="POST" action="{{route('posts.store', ['user_id'=>Auth::id()])}}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" name="title" value="{{old('title')}}" class="form-control" id="title">
        </div>
          
        <div class="form-group">
          <label for="content">Post</label>
          <textarea class="form-control" name="content" content="{{old('content')}}" id="content" rows="3" placeholder="Type post here..."></textarea>
        </div>

        <div class="form-group">
          <label for="image">Image</label>
          <div class="col-md-6">
            <input type="file" name="image" id="image">
          </div>
          <div class="col-md-6">
            {{-- <button type="submit" class="btn btn-success">Upload</button>
               --}}
            
          </div>
        </div>

        Tags: 
          {{--<select name="tags[]" multiple="multiple">
            @foreach (Tag::get() as $tag)
                <option value="{{ $tag->tag }}">{{ $tag->tag }}</option>
            @endforeach
        </select>--}} 
           
              @foreach (Tag::get()->unique() as $tag)
                <div class="form-check form-check-inline">
                  <input class="form-check-input" name="{{ $tag->tag }}" type="checkbox" id="{{ $tag->tag }}" value="{{ $tag->tag }}">
                  <label class="form-check-label" for="{{ $tag->tag }}">{{ $tag->tag }}</label>
                </div>
              @endforeach
             
        

        <button type="submit" class="btn btn-primary">Submit</button>
        <a class="btn btn-outline-dark" href="{{route('homepage')}}">Cancel</a>
    </form>
  @endauth
</div>
@endsection