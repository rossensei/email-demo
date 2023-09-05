@extends('base')

@section('content')
    <div class="container col-md-4 offset-md-4 mt-5">
        <h1 class="mb-3">Create your account</h1>
        
        <form action="{{'/register'}}" method="POST">
            {{ csrf_field() }}
            
            <div class="form-floating mb-3">
                <input type="text" name="name" class="form-control" id="floatingInput" placeholder="e.g Juan Dela Cruz">
                <label for="floatingInput">Name</label>
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-floating mb-3">
                <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Email</label>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-floating">
                <input type="password" name="password_confirmation" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Confirm Password</label>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-3">
                <a href="/">Sign in to your account</a>
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </form>
    </div>
@endsection