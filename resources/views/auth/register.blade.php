@extends('layouts.app')

@section('content')

<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    
    <div class="card p-4 shadow" style="width: 400px">

        <h4 class="text-center mb-3">Register</h4>

        <!-- ERROR SHOW -->
        @if ($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <input 
                type="text" 
                name="name" 
                class="form-control mb-2" 
                placeholder="Full Name"
                required
            >

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
                class="form-control mb-2" 
                placeholder="Password"
                required
            >

            <input 
                type="password" 
                name="password_confirmation" 
                class="form-control mb-3" 
                placeholder="Confirm Password"
                required
            >

            <button class="btn btn-success w-100">Register</button>
        </form>

        <p class="mt-3 text-center">
            Already have account? <a href="/login">Login</a>
        </p>

    </div>

</div>

@endsection