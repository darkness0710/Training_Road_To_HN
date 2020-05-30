@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">User Management</div>

                <div class="card-body">
                    {{ Form::open(['route'=>'users.search','method'=>'GET']) }}
                    {{ Form::text('search1','',['placeholder'=>'input name...'])}}
                    {{ Form::text('search2','',['placeholder'=>'input email...'])}}
                    {{ Form::submit('>>', ['class'=>'btn btn-primary'])}}
                    {{ Form::close() }}
                    {{-- <form action="/search" method="GET">
    <input type="search" name="search"> 
    <button type="submit" class="btn btn-primary"> >> </button>
</form>                       --}}
                    <table class="table table-stripped">
                        <tr>
                            <th>username</th>
                            <th>isAdmin</th>
                            <th>isBanned</th>
                            <th>action</th>
                            <th></th>
                        </tr>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->is_admin}}</td>
                            <td>{{$user->is_banned}}</td>
                            @if (Auth::user()->is_admin)

                            <td>
                                {{Form::open(['route'=>['users.ban',$user->id],'method'=>'POST','onsubmit'=>'return confirm("Ban this user?")'])}}
                                {{Form::submit('Ban',['class'=>'btn btn-danger'])}}
                                {{Form::close()}}
                            </td>
                            <td>
                                {{Form::open(['route'=>['users.uprole',$user->id],'method'=>'POST','onsubmit'=>'return confirm("Ban this user?")'])}}
                                {{Form::submit('SetAdmin',['class'=>'btn btn-danger'])}}
                                {{Form::close()}}
                            </td>
                            {{-- <td><a class="btn btn-danger">ban</a> <a class="btn btn-primary">unban</a></td> --}}
                        </tr>
                            @endif

                        @endforeach
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection