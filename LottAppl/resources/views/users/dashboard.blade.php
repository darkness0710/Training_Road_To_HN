@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>You are logged in!</p>
                    <p> Hello {{Auth::user()->name}}</p>
                    <div>
                    @if (Auth::user()->is_admin)
                        <p>you're admin!</p>
                            <a href="/users" class="btn btn-primary">View Users</a>
                    @endif
                    <a href="/lottery" class ="btn btn-primary">View Lottery</a>
                    <td>
                        {{Form::open(['route'=>['lottery.crawl'],'method'=>'POST'])}}
                        {{Form::submit('crawl',['class'=>'btn btn-danger'])}}
                        {{Form::close()}}
                    </td>
                    {{-- <td>
                        {{Form::open(['route'=>['lottery.latest'],'method'=>'get'])}}
                        {{Form::submit('latest',['class'=>'btn btn-danger'])}}
                        {{Form::close()}}
                    </td> --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
