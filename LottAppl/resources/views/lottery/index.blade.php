@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h1>Daily Lotto</h1>
    </div>
    @auth
    <div>
        <a class="btn btn-primary float-right" href="/lottery/add">Add</a>
        <a class="btn btn-primary float-right mr-1" href="/crawl">Crawl 1</a>
        <a class="btn btn-primary float-right mr-1" href="/crawltodb">Crawl to DB</a>
    </div>   
    @endauth
    <div class="float-left">
        {{ Form::open(['route'=>'lottery.search','method'=>'GET']) }}
        {{ Form::text('search1','',['placeholder'=>'search by date'])}}
        {{ Form::text('search2','',['placeholder'=>'search by number'])}}
        {{ Form::submit('>>', ['class'=>'btn btn-primary'])}}
        {{ Form::close() }}
    </div>
    <div>
        <table class="table table-stripped">
            <tr>
                <th>date</th>
                <th>result</th>
                <th>action</th>
                <th></th>
            </tr>
            @foreach ($lottos as $lott)
            <tr>
            <td><a href="lottery/{{$lott->id}}">{{$lott->date}}</a></td>
                <td>{{$lott->result}}</td>
                @if (Auth::user()->is_admin)
                <td>
                    {{Form::open(['route'=>['lottery.edit',$lott->id],'method'=>'GET'])}}
                    {{Form::submit('Edit',['class'=>'btn btn-danger'])}}
                    {{Form::close()}}
                </td>
                <td>
                    {{Form::open(['route'=>['lottery.delete',$lott->id],'method'=>'POST','onsubmit'=>'return confirm("Ban this user?")'])}}
                    {{Form::hidden('_method','DELETE')}}
                    {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
                    {{Form::close()}}
                </td>
            </tr>
                @endif

            @endforeach
        </table>

    </div>
</div>
@endsection