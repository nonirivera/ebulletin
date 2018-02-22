@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="well" id="welcome-well">
                    <h1> Welcome to eBulletin,</h1>
                    <h2>share your thoughts and communicate.</h2>
                    <br>
                    @if(Auth::guest())
                        <a class="btn btn-primary btn-sm" href="/register">Register</a> <strong>and subscribe to threads that suit your taste.</strong>
                    @endif
                </div>
                <br>
                <h3>Recent Posts</h3>
                {{-- populate posts --}}
                <div class="list-group">
                    @foreach($posts as $post)
                    
                    <div class="list-group-item">
                        <a href="posts/{{$post->id}}"><h4 class="list-group-item-heading">{{ $post->title }}</h4></a>
                        <p class="list-group-item-text"><small>Submitted by <a href="users/{{$post->user->id}}">{{ $post->user->username }}</a> on <a href="/threads/{{ $post->threads['id'] }}">{{ $post->threads['name'] }}</a> | {{$post->created_at->diffForHumans() }}</small></p>
                    </div>
                    
                    @endforeach
                    {{$posts->links()}}
                </div>
            </div>

            {{-- Show login panel if guest --}}
            
            <div class="col-md-3">
            @if(Auth::guest())
                <h3>Hello there!</h3>
                <p>Sign in <a href="login"><strong>here</strong></a> to make a post.</p>
                <p>Not registered yet? <a href="register"><strong>Sign up now!</strong></a></p>
            @endif
            {{-- login panel end --}}
            <br>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">Content Policy</h3>
                    </div>
                    <div class="panel-body">
                        <p><strong>eBulletin</strong> is a platform for communities to discuss, 
                        connect, and share in an open environment, 
                    home to some of the most authentic content anywhere online. </p>
                    <p>The nature of this content might be funny, serious, offensive, or anywhere in between. </p>
                    <p>While participating, it’s important to keep in mind this value above all others: 
                    show enough respect to others so that we all may continue to enjoy Reddit for what it is.</p>
                    </div>
                </div>
                <hr>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">Discussion Guidelines</h3>
                    </div>
                    <div class="panel-body">
                        <p class="text-center"><span class="label label-success">Engage in good faith</span></p>
                        Healthy communities are those where participants engage in good faith, 
                        and with an assumption of good faith for their co-collaborators. 
                        It’s not appropriate to attack your own users. Communities are active, in 
                        relation to their size and purpose, and where they are not, 
                        they are open to ideas and leadership that may make them more active.
                        <p></p>
                        <br>
                        <p class="text-center"><span class="label label-success">Respect the Platform</span></p>
                        eBulletin may, at its discretion, 
                        intervene to take control of a community when it believes it in 
                        the best interest of the community or the website.
                    </div>
                </div>
            </div>


            </div>
        </div>
    </div>
@endsection
