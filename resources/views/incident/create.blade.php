@extends('layout')

@section('content')
<div class="container">
    <h2>Report an Incident</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('incident.store') }}" method="POST">
        @csrf

        <label>Location:</label>
        <input type="text" name="location" class="form-control" required><br>

        <label>Date & Time of Incident:</label>
        <input type="datetime-local" name="incident_time" class="form-control" required><br>

        <label>Description:</label>
        <textarea name="description" rows="4" class="form-control" required></textarea><br>

        {{-- ✅ Add this block here for Anonymous Option --}}
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="is_anonymous" value="1" id="is_anonymous">
            <label class="form-check-label" for="is_anonymous">
                Submit Anonymously
            </label>
        </div>

        <button type="submit" class="btn btn-danger">Submit Report</button>
    </form>
</div>
@endsection