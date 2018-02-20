@extends('layouts.app')

@section('content')
    <div class="col-md-9 col-sm-9">
        @if(count($posts) > 0)
            @foreach($posts as $post)
                <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                <small>Submitted by {{ $post->user->name }} | {{$post->created_at->diffForHumans() }}</small>
            @endforeach
            {{$posts->links()}}
        @else
            <p>No posts found</p>
        @endif
    </div>

    <div class="col-md-3 col-sm-3">
        <div class="text-center">

            <div class="well">
                Your profile
            </div>
            <a href="posts/create" class="btn btn-primary btn-sm">Create Post</a>
        </div>
    </div>
@endsection