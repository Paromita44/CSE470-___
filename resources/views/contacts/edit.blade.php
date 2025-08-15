@extends('layout')

@section('content')
<div class="container">
    <h2>Edit Emergency Contact</h2>

    <form method="POST" action="{{ route('contacts.update', $contact->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $contact->name }}" required>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" name="phone" id="phone" class="form-control" value="{{ $contact->phone }}" required>
        </div>

        <div class="mb-3">
            <label for="relationship" class="form-label">Relationship</label>
            <input type="text" name="relationship" id="relationship" class="form-control" value="{{ $contact->relationship }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Contact</button>
    </form>
</div>
@endsection