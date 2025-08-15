@extends('layout')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 bg-dark text-white p-3">
            <h4 class="text-center">Dashboard</h4>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('profile.edit') }}">
                        <i class="fas fa-user"></i> Edit Profile
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('incident.create') }}">
                        <i class="fas fa-exclamation-circle"></i> Report Incident
                    </a>
                </li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-danger w-100">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>

        <!-- Main Content Area -->
        <div class="col-md-9">
            <div class="content-box p-4" style="background: rgba(245, 240, 240, 0.8); border-radius: 8px; height: 71vh; opacity: 0.9;">
                <h2>Welcome, {{ Auth::user()->name }}!</h2>
                <p>You are now logged in to the Women's Safety & Emergency Support Platform.</p>

                <!-- Emergency Contacts Button -->
                <div class="mt-4">
                    <a href="{{ route('contacts.index') }}" class="btn btn-primary btn-lg mb-3">
                        Go to Emergency Contacts
                    </a>
                </div>
                <div class="mt-4">
                    <h4>Your Recent Activities</h4>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card text-white bg-primary mb-3" style="opacity: 0.8;">
                                <div class="card-header">Last Reported Incident</div>
                                <div class="card-body">
                                    <p class="card-text"></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card text-white bg-warning mb-3" style="opacity: 0.8;">
                                <div class="card-header">Upcoming Tasks</div>
                                <div class="card-body">
                                    <p class="card-text"></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card text-white bg-success mb-3" style="opacity: 0.8;">
                                <div class="card-header">Profile Update</div>
                                <div class="card-body">
                                    <p class="card-text"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection