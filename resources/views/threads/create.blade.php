@extends('layouts.app')

@section('content')

    <h1>Create Thread</h1>
     @include('inc.errors')
    
    {!! Form::open(['action' => 'ThreadsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('title', 'Name')}}
            {{Form::text('title', '', ['class'=>'form-control', 'placeholder'=>'Thread Name'])}}
        </div>
        <div class="form-group">
            {{ Form::label('description', 'Description') }}
            {{ Form::text('description', '', ['class'=>'form-control', 'placeholder'=>'Description']) }}
        </div>
        <div class="form-group">
            {{Form::label('miscellaneous', 'Miscellaneous (Thread rules, regulations, FAQ go here)')}}
            {{Form::textarea('miscellaneous', '', ['id' => 'article-ckeditor', 'class'=>'form-control', 'placeholder'=>'miscellaneous'])}}
        </div>
        <div class="form-group">
            {{ Form::file('cover_image') }}
        </div>
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}

@endsection