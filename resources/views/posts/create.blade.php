{{--Shows a 'new post creation' page.--}}

@extends("layouts.app")

@section('title', 'Create Post')

@section('content')
<div class="container-fluid my-3 border">

    <form method="POST" action="{{route('posts.store', ['user_id'=>Auth::id()])}}">
        @csrf
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" name="title" value="{{old('title')}}" class="form-control" id="title">
        </div>
          
        <div class="form-group">
          <label for="content">Post</label>
          <textarea class="form-control" name="content" content="{{old('content')}}" id="content" rows="3" placeholder="Type post here..."></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="button" class="btn btn-link">
            <a href="{{route('homepage')}}">Cancel</a>
        </button>
    </form>

</div>
@endsection