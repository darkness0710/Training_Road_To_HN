@extends('layouts.app')

@section('content')
<h1>Create new post here</h1>
{!! Form::open(['action'=>'PostsController@store','method' =>'POST']) !!}
<div class="form-group">
    {{Form::label('title','Title')}}
    {{Form::text('title','',['class'=>'form-control','placeholder'=>'Post title...'])}}
</div>
<div class="form-group">
    {{Form::label('body','Body')}}
    {{Form::textArea('body','',['id'=>'article-ckeditor','class'=>'form-control','placeholder'=>'Start here...'])}}
</div>
{{Form::submit('submit',['class'=>'btn btn-primary'])}}
{!! Form::close() !!}
@endsection