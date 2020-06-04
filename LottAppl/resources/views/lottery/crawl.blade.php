{{-- {{dd($data)}} --}}
@extends('layouts.app')

@section('content')
<h1>Crawl by Date</h1>
{!! Form::open(['route'=>'lottery.crawlaction','method' =>'GET']) !!}
<div class="form-group">
    {{Form::label('date','Date')}}
    {{Form::date('date', \Carbon\Carbon::now())}}
    {{Form::submit('submit',['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
</div>
<div>
    <p> The Special Prize of {{$result['date'] ?? ''}} is {{$result['prize'] ?? ''}}</p>
</div>
@endsection