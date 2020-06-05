@extends('layouts.app')

@section('content')
<h1>Upload Lottery Data</h1>
@if(Session::has('message'))
<div>{{ Session::get('message') }}</div>
@endif
<div class="form-group">
{!! Form::open(['route'=>'lottery.uploadAction','method' =>'POST','enctype'=>'multipart/form-data']) !!}
{{Form::label('file','File')}}
{{Form::file('file')}}
{{Form::submit('submit',['class'=>'btn btn-primary'])}}
{!! Form::close() !!}
</div>
@endsection