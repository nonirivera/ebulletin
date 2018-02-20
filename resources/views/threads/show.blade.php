@extends('layouts.app')

@section('content')
<div class="row">
    <img class="img-responsive center-block" src="/storage/cover_images/{{$thread->cover_image}}" alt="">
</div>
<hr>
<div class="row">
  <div class="col-md-9">
    <div class="list-group">
      @foreach($thread->posts as $post)
        <div class="list-group-item">
            <a href="../posts/{{$post->id}}"><h4 class="list-group-item-heading">{{ $post->title }}</h4></a>
            <p class="list-group-item-text"><small>Submitted by {{ $post->user->name }} | {{$post->created_at->diffForHumans() }}</small></p>
        </div>    
      @endforeach
    </div>
  </div>
  <div class="col-md-3">
    <a href="/posts/create/{{$thread->id}}" class="btn btn-primary btn-lg btn-block">Submit new post</a>
    <br>
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title text-center">{{ $thread->name }}</h3>
        </div>
        <div class="panel-body">
            {{ $thread->description }}
        </div>
    </div>
    <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title text-center">Guidelines</h3>
            </div>
            <div class="panel-body">
                {!! $thread->miscellaneous !!}
            </div>
        </div>
  </div>
</div>
@endsection