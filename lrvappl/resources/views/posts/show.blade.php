@extends('layouts.app')

@section('content')
<h1>{{$post->title}}</h1>
<a href="/posts" class="btn btn-default">Back</a>
<div>
<img style="width: 100%" src="/storage/cover_images/{{$post->cover_image}}">
</div>
<div>
    {{$post->body}}
</div>
<hr>
<small>Upload on {{$post->created_at}} by {{$post->user->name}}</small>
<hr>
{{-- @if(!Auth::guest())
    @if (Auth::user()->id ==$post->user_id)     --}}
@if(Auth::user() == $post->user)
    <a href="/posts/{{$post->id}}/edit" class="btn btn-primary">Edit</a>
    {{Form::open(['action'=>['PostsController@destroy',$post->id],'method'=>'POST','class'=>'float-right','onsubmit'=>'return confirm("DELETE THIS POST?")'])}}
        {{Form::hidden('_method','DELETE')}}
        {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
    {{Form::close()}}
@endauth
    {{-- @endif
@endif --}}
@endsection