@extends('layouts.app')

@section('content')
{{dd($lott)}}
{{-- <h1>{{$lott->date}} Result</h1>
{!! Form::open(['action'=>'LotteryController@store','method' =>'POST']) !!}
@auth
<a class="btn btn-primary float-right" href="lottery/{{$lott->id}}/edit">edit</a>
@endauth
<p>
    {{$lott->body}}
</p> --}}
@endsection