@extends('layouts.app')

@section('content')

<div class="row">
    <a href="/threads/{{ $thread_name->id }}" data-toggle="tooltip" title="Go back to {{ $thread_name->name }}">
        <img class="img-responsive center-block" src="/storage/cover_images/{{$thread_name->cover_image}}" alt="">
    </a>
</div>
<hr>
    <div class="col-md-9 col-sm-9">
        <h2>{{$post->title}}</h2>
        {{-- hide edit/delete buttons for guests --}}
        @if(!Auth::guest())
            {{-- show buttons only for post's specific user --}}
            @if(Auth::user()->id === $post->user_id)
                <div class="well">
                    <a href="/posts/{{$post->id}}/edit" class="btn btn-info btn-sm">Edit</a>

                    {!! Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right']) !!}
                        {{ Form::hidden('_method', 'DELETE') }}
                        {{ Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) }}
                    {!! Form::close() !!}
                </div>
            @endif
        @endif
        <small>Written {{ $post->created_at->diffForHumans() }} by {{ $post->user->name }}</small>
        
        <div class="well">
            {!! $post->body !!}
        </div>

        

        {{-- comment --}}
        <div class="well">
            {{ Form::open(['method'=>'POST', 'action'=>'CommentsController@store']) }}
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <textarea name="body" id="" cols="60" rows="5" placeholder="Submit a comment"></textarea>
            <br>
            <br>
            {{ Form::submit('Save', ['class' => 'btn btn-primary btn-md']) }}
            {{ Form::close() }}
        </div>

        {{-- populate comments --}}
        <div class="comments">
            @if(count($post->comments) > 0)
                <ul class="list-group">
                    @foreach($post->comments as $comment)
                        <li class="list-group-item">
                            <small>submitted by <a href="">{{ $comment->user->username }}</a> | {{ $comment->created_at->diffForHumans() }}</small>
                            <h4>{{ $comment->body }}</h4>
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="well text-center">
                    <h3>No discussion yet</h3>
                </div>
            @endif
        </div>
    </div>

    <div class="col-md-3 col-sm-3">
        <a href="/posts/create/{{$thread_name->id}}" class="btn btn-primary btn-lg btn-block">SUBMIT A NEW POST</a>
        <br>
        <div class="well text-center">
            <h4>This post was submitted on</h4>
            <h3>{{ $post->created_at->toDayDateTimeString() }}</h3>
        </div>
    </div>
@endsection