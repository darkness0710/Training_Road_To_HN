@extends('layouts.app')

@section('content')
    <h1>{{$post->title}}</h1>
    <div>
        {{$post->body}}
    </div>
    <hr>
    <small>Upload on {{$post->created_at}}</small>
    <hr>
    <a href="/posts" class="btn btn-default">Back</a>
@endsection