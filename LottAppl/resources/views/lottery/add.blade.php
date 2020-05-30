@extends('layouts.app')

@section('content')
<h1>Add Daily Result</h1>
{!! Form::open(['action'=>'LotteryController@store','method' =>'POST']) !!}
<div class="form-group">
    {{Form::label('date','Date')}}
    {{Form::text('date','',['class'=>'form-control','placeholder'=>'Result Date (ddMMMyy)'])}}
</div>
<div class="form-group">
    {{Form::label('result','Result')}}
    {{Form::textArea('result','',['class'=>'form-control','placeholder'=>'Start here...'])}}
</div>
    {{Form::submit('submit',['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection