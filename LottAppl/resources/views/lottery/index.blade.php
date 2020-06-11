@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h1>Daily Lotto</h1>
    </div>
    @auth
    <div class="float-right">
        <a class="btn btn-primary" href="/lottery/add">Add</a>
        <a class="btn btn-primary" href="/crawl">Crawl 1</a>
        <a class="btn btn-primary" href="/crawltodb">Crawl to DB</a>
        <a class="btn btn-primary" href={{route('lottery.upload.view')}}>Upload</a>
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
                <td>{!! link_to_route('lottery.show',formatDateView($lott->date),['id' => $lott->id])!!}</td>
                <td>{{$lott->result}}</td>
                {{-- @if (Auth::user()->is_admin) --}}
                <td>
                    {{Form::open(['route'=>['lottery.edit',$lott->id],'method'=>'GET'])}}
                    {{Form::submit('Edit',['class'=>'btn btn-danger'])}}
                    {{Form::close()}}
                </td>
                <td>
                    {{Form::open(['route'=>['lottery.delete',$lott->id],'method'=>'POST','onsubmit'=>'return confirm("Delete This Day?")'])}}
                    {{Form::hidden('_method','DELETE')}}
                    {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
                    {{Form::close()}}
                </td>
            </tr>
                {{-- @endif --}}

            @endforeach
        </table>
        {{$lottos->links()}}
    </div>
</div>
@endsection