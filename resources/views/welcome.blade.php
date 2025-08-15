@extends('layout')

@section('title', 'Women’s Safety & Emergency Support Platform')

@section('content')
<div class="d-flex flex-column align-items-center justify-content-start" style="height: 100vh; background-image: url('{{ asset('images/Background.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">

    <!-- Box for the Welcome Text -->
    <div class="content-box text-center bg-light bg-opacity-75 p-4 rounded shadow" style="max-width: 100%; width: 100%; margin-bottom: 20px; text-align: center;">
        <h2 style="margin: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Women’s Safety & Emergency Support Platform</h2>
    </div>

    <!-- Box for Login and Registration with "Welcome" Text at the top -->
    <div class="content-box text-center bg-light bg-opacity-75 p-4 rounded shadow" style="max-width: 400px; width: 80%;">
        <h3>Welcome</h3>  <!-- "Welcome" Text Added here -->
        
        <div class="mt-4">
            <a href="{{ route('login') }}" class="btn btn-primary btn-lg mb-3" style="width: 100%;">Login</a>
            <a href="{{ route('registration') }}" class="btn btn-secondary btn-lg" style="width: 100%;">Registration</a>
        </div>
    </div>
</div>
@endsection