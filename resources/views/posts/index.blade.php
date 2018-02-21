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
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Recent Comments</h3>
            </div>
            <div class="panel-body">
                @foreach($comments as $comment)
                    <p><small><a href="posts/{{$comment->post_id}}">{{ str_limit($comment->body, $limit = 30, $end = '...') }}</a></small></p>
                    <p><small>by {{ $comment->user->username }}</small></p>
                    <br>
                @endforeach
            </div>
        </div>
    </div>
@endsection