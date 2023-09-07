@extends('base')

@section('content')
    <div class="container mt-5 col-md-4 offset-md-4">
        <h1>Dashboard</h1>

        <div class="card p-2 d-flex justify-content-center align-items-center mb-3">
            <p class="mb-0">You are logged in as {{ auth()->user()->name }}</p>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            {{ csrf_field() }}
            <button type="submit" class="btn btn-sm btn-primary">Logout</button>
        </form>
    </div>
    
@endsection
