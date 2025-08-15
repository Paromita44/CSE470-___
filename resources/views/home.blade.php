@extends('layout')

@section('content')
<div class="container">

    {{-- ✅ Show success message if present --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <h2>Welcome, {{ Auth::user()->name }}!</h2>
    <p>You are now logged in to the Women's Safety & Emergency Support Platform.</p>

    <a href="{{ route('profile.edit') }}" class="btn btn-primary">
        Edit Profile
    </a>

    <a href="{{ route('incident.create') }}" class="btn btn-danger mt-2">
        Report Incident
    </a>

</div>
@endsection