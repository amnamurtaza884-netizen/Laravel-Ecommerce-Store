@extends('layouts.app')

@section('content')

<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    
    <div class="card p-4 shadow" style="width: 400px">

        <h4 class="text-center mb-3">Login</h4>

        <!-- ERROR SHOW -->
        @if ($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <input 
                type="email" 
                name="email" 
                class="form-control mb-2" 
                placeholder="Email"
                required
            >

            <input 
                type="password" 
                name="password" 
                class="form-control mb-3" 
                placeholder="Password"
                required
            >

            <!-- REMEMBER -->
            <div class="form-check mb-3">
                <input type="checkbox" name="remember" class="form-check-input">
                <label class="form-check-label">Remember me</label>
            </div>

            <button class="btn btn-dark w-100">Login</button>
        </form>

        <p class="mt-3 text-center">
            Don't have account? <a href="/register">Register</a>
        </p>

    </div>

</div>

@endsection