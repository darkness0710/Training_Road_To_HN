@extends('layouts.app')

@section('content')
<h1>{{$lott->date}} Result</h1>
<div>
    <p>
        {{$lott->result}}
    </p>
</div>
@endsection