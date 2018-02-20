@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-9 col-sm-9">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h3>Your Bulletin Posts</h3>
                    {{-- @foreach($posts as $post)
                        {{ $post->body }}
                        <br>
                    @endforeach --}}
                    @if(count($posts) > 0)
                        <table class="table table-striped">
                            <tr>
                                <th>Title</th>
                                <th></th>
                                <th></th>
                            </tr>
                            @foreach($posts as $post)
                            <tr>
                                <td><a href="posts/{{$post->id}}">{{$post->title}}</a></td>
                                <td><a href="/posts/{{$post->id}}/edit" class="btn btn-success">Edit</td>
                                <td>
                                    {!! Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right']) !!}
                                        {{ Form::hidden('_method', 'DELETE') }}
                                        {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    @else
                        <p>You currently have no posts</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-3">
            <div class="well">
                <div class="thumbnail">
                    <img src="https://www.redditstatic.com/avatars/avatar_default_16_25B79F.png" />
                </div>
                <h4 class="text-center">{{ Auth::user()->username }}</h4>
                <br>
            </div>
        </div>
    </div>
</div>
@endsection
