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
                <div class="col-md-2">
                    <a href="/posts/{{$post->id}}/edit" class="btn btn-info btn-sm">Edit</a>

                    {!! Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right']) !!}
                        {{ Form::hidden('_method', 'DELETE') }}
                        {{ Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) }}
                    {!! Form::close() !!}
                </div>
            @endif
        @endif
        <small>Written on {{ $post->created_at->toDayDateTimeString() }} by {{ $post->user->name }}</small>
        
        <div class="well">
            {!! $post->body !!}
        </div>

        

        {{-- comment --}}
        <div class="well">
            <textarea name="" id="" cols="60" rows="5" placeholder="Submit a comment"></textarea>
            <br>
            <br>
            {{ Form::submit('Save', ['class' => 'btn btn-primary btn-md']) }}
        </div>

        {{-- populate comments --}}
        <div class="comments">
            @if(count($post->comments) > 0)
                <ul class="list-group">
                    @foreach($post->comments as $comment)
                        <li class="list-group-item">
                            <small>{{ $comment->created_at->toDayDateTimeString() }}</small>
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
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title text-center">sub name</h3>
            </div>
            <div class="panel-body">
                Panel content
            </div>
        </div>

        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title text-center">sub name</h3>
            </div>
            <div class="panel-body">
                <ul>
                    <li>One two three</li>
                    <li>One two three</li>
                    <li>One two three</li>
                    <li>One two three</li>
                    <li>One two three</li>
                    <li>One two three</li>
                    <li>One two three</li>
                    <li>One two three</li>
                    <li>One two three</li>
                    <li>One two three</li>
                    <li>One two three</li>
                    <li>One two three</li>
                    <li>One two three</li>
                </ul>
            </div>
        </div>
    </div>
@endsection