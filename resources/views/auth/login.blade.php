@extends('base')

@section('content')
    <div class="container col-md-4 offset-md-4 mt-5">
        <h1 class="mb-3">Log in to your account</h1>
        
        <form action="{{'/login'}}" method="POST">
            {{ csrf_field() }}

            <div class="form-floating mb-3">
                <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Email</label>
            </div>
            <div class="form-floating">
                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-3">
                <a href="/register">Create an account</a>
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </form>
    </div>
@endsection