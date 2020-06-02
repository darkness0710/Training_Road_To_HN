{{-- {{dd($data)}} --}}
@extends('layouts.app')

@section('content')
<h1>Latest </h1>
{!! Form::open(['route'=>'lottery.test','method' =>'get']) !!}
<div class="form-group">
    {{-- from --}}
    {{Form::label('from','From')}}
    {{Form::date('from', )}}
    {{-- to --}}
    {{Form::label('to','To')}}
    {{Form::date('to', )}}
</div>
{{Form::submit('submit',['class'=>'btn btn-primary'])}}
{!! Form::close() !!}

{{-- <div>
    <table class="table table-stripped">
        <tr>
            <th>date</th>
            <th>result</th>
        </tr>
        @foreach ($data as $item)
        <tr>
            <td>{{$item->date}}</td>
            <td>{{$item->result}}</td>
        </tr>
        @endforeach
    </table>
</div> --}}

@endsection