@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-7">
    <div class="alert alert-info" role="alert">Search Result</div>
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
      @else
        That thread does not exist.
      @endif
      </div>
  </div>
  <div class="col-md-2">
    
  </div>
  <div class="col-md-3">
    
  </div>
</div>
@endsection