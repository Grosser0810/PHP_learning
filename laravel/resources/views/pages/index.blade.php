@extends('layout')
@section('content')
<div class="container">
    @foreach($posts as $post)
        <div class="card mb-6">
            <img src="{{$post->getImage()}}" class="card-img-top" alt="...">
            <div class="card-body">
                <header class="entry-header text-center text-uppercase">
                    <h6><a href="">{{$post->category->title}}</a></h6>
                    <h3 class="entry-title"><a href="{{route('post.show', $post->slug)}}">{{$post->title}}</a></h3>
                </header>
                <p class="card-text">{{$post->description}}</p>
                <p class="card-text"><small class="text-muted">{{$post->date}}</small></p>
            </div>

        </div>
    @endforeach

</div>
    @endsection
