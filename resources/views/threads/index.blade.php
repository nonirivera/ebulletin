@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-6">
    <div class="alert alert-info" role="alert">List of Threads</div>
      <div class="container">
      @if(count($thread) > 0)
        @foreach($thread as $t)
          <a href="threads/{{ $t->id }}"><h3>{{$t->name }}</h3></a>
          <small>an eBulletin thread for {{ $t->created_at->diffForHumans(null, true) }}</small>
          <p>{{ $t->description }}</p>
          <div class="row">
            <div class="col-md-3">
            <hr>
          </div>
          </div>
        @endforeach
        {{ $thread->links() }}
      @else
        No threads at the moment
      @endif
      </div>
  </div>
  <div class="col-md-4">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Recently Created Threads</h3>
      </div>
      <div class="panel-body">
        @foreach($recent as $r)
          <h4><a href="threads/{{$r->id}}">{{$r->name}}</a></h4>
          <small>{{$r->description }}</small>
          <p></p>
        @endforeach
      </div>
    </div>    
  </div>
  <div class="col-md-2">
    <!-- placeholder access restriction for now -->
    @if(Auth::user()->id === 1)
      <a href="threads/create" class="btn btn-primary btn-lg btn-block">Create Thread</a>
    @endif
  </div>  
</div>
@endsection