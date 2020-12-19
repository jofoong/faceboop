@extends("layouts.app")

@section('content')
<div class="container">
    @foreach($posts as $post)
        <p>{{$post->created_at}}</p>
    @endforeach
</div>
@endsection