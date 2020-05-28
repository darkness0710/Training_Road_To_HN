@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">User Management</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{-- {{ Form::open(['action'=>'UserController@search','method'=>'GET']) }}
                    {{ Form::label('username','Username')}}
                    {{ Form::text('search','',['placeholder'=>'input query...'])}}
                    {{ Form::submit('Search', ['class'=>'btn btn-primary'])}}
                    {{ Form::close() }} --}}
<form action="/search" method="GET">
    <input type="search" name="search"> 
    <button type="submit" class="btn btn-primary"> >> </button>
</form>                      
                      <table class="table table-stripped">
                        <tr>
                            <th>username</th>
                            <th>isAdmin</th>
                            <th>action</th>
                        </tr>
                            @foreach ($users as $user)
                        <tr>
                            <th>{{$user->name}}</th>
                            <th>{{$user->is_admin}}</th>
                            <th><a class="btn btn-danger">ban</a></th>
                        </tr>
                            @endforeach
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
