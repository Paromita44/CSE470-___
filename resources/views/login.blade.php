@extends('layout')

@section('title', 'Login')

@section('content')
<div class="d-flex flex-column align-items-center justify-content-start" style="height: 100vh; background-image: url('{{ asset('images/Background.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">

    <!-- "Back to Home" Button at the top left of the background -->
    <a href="{{ route('home') }}" class="btn btn-secondary" style="position: absolute; top: 10px; left: 10px; padding: 10px 20px; font-size: 14px; display: flex; align-items: center; background-color: transparent; border: none; color: #000; text-decoration: none;">
        <i class="fas fa-arrow-left" style="margin-right: 8px;"></i>Back to Home
    </a>

    <!-- Box for the Login Form with double black border -->
    <div class="content-box text-center bg-light bg-opacity-75 p-4 rounded shadow" style="max-width: 500px; width: 90%; margin-top: 200px; border: 3px solid #000; border-radius: 15px; box-shadow: 0 0 10px 2px rgba(0, 0, 0, 0.5); padding: 20px;"> <!-- Adjusted padding inside the box -->

        <!-- Inside the box, make everything aligned to the left -->
        <h3 style="text-align: center; margin-left: 20px;">Login</h3>

        <form method="POST" action="{{ route('login.post') }}">
            @csrf
            <div class="mb-3" style="text-align: left; margin-left: 20px;">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>

            <div class="mb-3" style="text-align: left; margin-left: 20px;">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <!-- Shrinking the Login button width -->
            <button type="submit" class="btn btn-primary btn-lg mb-3" style="width: auto; padding: 12px 50px;">Login</button> <!-- Reduced width -->
        </form>
    </div>
</div>
@endsection