@extends('layouts.app')

@section('content')
<h1>Add Daily Result</h1>
{!! Form::open(['action'=>['LotteryController@update',$lott->id],'method' =>'POST']) !!}
{!! Form::hidden('_method','PUT') !!}
<div class="form-group">
    {{Form::label('date','Date')}}
    {{Form::text('date',formatDateView($lott->date),['class'=>'form-control','placeholder'=>'Result Date (ddMMMyy)'])}}
</div>
<div class="form-group">
    {{Form::label('result','Result')}}
    {{Form::textArea('result',$lott->result,['class'=>'form-control','placeholder'=>'Start here...'])}}
</div>
    {{Form::submit('submit',['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection