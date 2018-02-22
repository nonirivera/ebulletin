@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-9 col-sm-9">
        <!--- USER TABS -->
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#home">Visitor Messages</a></li>
            <li><a data-toggle="tab" href="#menu1">Posts Created</a></li>
        </ul>

        <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
            <p></p>
                @if(count($messages) > 0)
                    <div class="row">
                        <div class="col-md-8">
                            @foreach($messages as $message)
                                <div class="well well-sm">
                                    <p>{{ $message->message }}</p> 
                                    <small>{{ $message->created_at->diffForHumans() }}</small>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <p>No visitor message.</p>
                @endif
            </div>
            <div id="menu1" class="tab-pane fade">
                <h3>{{ $user->username }}'s Post(s)</h3>
                    @if(count($posts) > 0)
                        <table class="table table-striped">
                            <tr>
                                <th>Title</th>
                            </tr>
                            @foreach($posts as $post)
                            <tr>
                                <td><a href="posts/{{$post->id}}">{{$post->title}}</a></td>
                            </tr>
                            @endforeach
                        </table>
                    @else
                        <p>User currently has no posts.</p>
                    @endif
            </div>
        </div>        
        <!-- USER TABS END -->
            <br>
            <div class="panel panel-info">
                <div class="panel-heading">Send {{ $user->username }} a message</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ Form::open(['method'=>'POST', 'action'=>'UsersController@send_message']) }}
                        <input type="hidden" value="{{Auth::user()->id}}" name="message_sender">
                        <input type="hidden" value="{{$user->id}}" name="user_id">
                        <textarea name="message" id="" cols="80" rows="3"></textarea>
                        <p></p>
                        <input type="submit" class="btn btn-primary btn-md" value="Submit" name="submessage">
                    {{ Form::close() }}
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-3">
            <div class="well">
                <div class="thumbnail">
                    <img src="https://www.redditstatic.com/avatars/avatar_default_16_25B79F.png" />
                </div>
                <h3 class="text-center">{{ $user->username }}</h3>
                <h4 class="text-center">{{ $user->name }}</h4>
                <br>
            </div>
            <p class="text-center"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> {{ $user->email }}</p>
            <hr>
            <p class="text-center"><b>eBulletin Birthday</b></p>
            <p class="text-center"><span class="glyphicon glyphicon-gift" aria-hidden="true"> {{ $user->created_at->toFormattedDateString() }}</span></p>

        </div>
    </div>
</div>
@endsection
