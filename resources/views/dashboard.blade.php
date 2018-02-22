@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-9 col-sm-9">
            <div class="panel panel-default">
                <div class="panel-heading">Account Activity</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h3>Your eBulletin Posts</h3>
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
                    <h3>Your Visitor Messages</h3>
                    @if(count($message) > 0)
                        <table class="table table-striped">
                            <tr>
                                <th></th>
                            </tr>
                            @foreach($message as $message)
                            <tr>
                                <td>{{$message->message}}</td>
                            </tr>
                            @endforeach
                        </table>
                    @else
                        <p>You currently have no visitor messages.</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-3">
            <div class="well">
                <div class="thumbnail">
                    <img src="https://www.redditstatic.com/avatars/avatar_default_16_25B79F.png" />
                </div>
                <h3 class="text-center">{{ Auth::user()->username }}</h3>
                <h4 class="text-center">{{ Auth::user()->name }}</h4>
                <br>
            </div>
            <p class="text-center"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> {{ Auth::user()->email }}</p>
            <hr>
            <p class="text-center"><b>eBulletin Birthday</b></p>
            <p class="text-center"><span class="glyphicon glyphicon-gift" aria-hidden="true"> {{ Auth::user()->created_at->toFormattedDateString() }}</span></p>
        </div>
    </div>
</div>
@endsection
