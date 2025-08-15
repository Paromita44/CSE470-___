@extends('layout')

@section('content')
<div class="container">
    <h2>Add New Emergency Contact</h2>
    
    <!-- Success or Error Message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('contacts.store') }}">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" name="phone" id="phone" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="relationship" class="form-label">Relationship</label>
            <input type="text" name="relationship" id="relationship" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Add Contact</button>
    </form>
</div>
@endsection