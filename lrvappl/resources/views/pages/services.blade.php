@extends('layouts.app')

@section('content')
    <h1>{{$title}}</h1>
    <p>72 phep than thong nhu Ton Ngo Khong</p>
    @if (count($services)>0)
    <ul class="list-group">  
        @foreach ($services as $service)
            <li class="list-group-item">{{$service}}</li>
        @endforeach

    </ul>
        
    @endif
@endsection
