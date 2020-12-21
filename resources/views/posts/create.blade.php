@extends("layouts.app")

@section('content')
<div class="container-fluid my-3 border">
    <form method="POST" action="{{route('posts.store')}}">
        @csrf
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="title">Title</span>
            </div>
            <input type="text" class="form-control" name="title" aria-label="Title" aria-describedby="title">
        </div>

        <div class="input-group mb-3">
            <form>
                <label for="content" style="visibility:hidden">Content</label>
                <textarea class="form-control mb-2 mr-sm-2" name="content" id="content" placeholder="Type your post here..."></textarea>
            </form>
        </div>

            <button class="btn btn-outline-primary" type="submit" value="Submit">
                <a href="{{route('posts.create')}}">Post!</a>
            </button>
            <button type="button" class="btn btn-link">
                <a href="{{route('homepage')}}">Cancel</a>
            </button>
            
    </form>
</div>
@endsection