@extends('layouts.app')
@section('content')
<table class="table table-stripped">
    <tr>
        <th>username</th>
        <th>isAdmin</th>
        <th>action</th>
        <th></th>

    </tr>
        @foreach ($users as $user)
    <tr>
        <th>{{$user->name}}</th>
        <th>{{$user->is_admin}}</th>
        <th><a class="btn btn-danger">ban</a></th>
        <th><a class="btn btn-primary">unban</a></th>
        @endforeach
</table>
@endsection