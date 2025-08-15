@extends('layout')

@section('content')
<div class="container">
    <h2>Edit Profile</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label>Phone:</label>
        <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"><br>

        <label>Address:</label>
        <input type="text" name="address" value="{{ old('address', $user->address) }}"><br>

        <label>Gender:</label>
        <select name="gender">
            <option value="">Select</option>
            <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>Male</option>
            <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>Female</option>
            <option value="other" {{ $user->gender == 'other' ? 'selected' : '' }}>Other</option>
        </select><br>

        <label>Date of Birth:</label>
        <input type="date" name="dob" value="{{ old('dob', $user->dob) }}"><br>

        <label>NID:</label>
        <input type="text" name="nid" value="{{ old('nid', $user->nid) }}"><br>

        <label>Emergency Contact 1:</label>
        <input type="text" name="emergency_contact_1" value="{{ old('emergency_contact_1', $user->emergency_contact_1) }}"><br>

        <label>Emergency Contact 2:</label>
        <input type="text" name="emergency_contact_2" value="{{ old('emergency_contact_2', $user->emergency_contact_2) }}"><br>

        <label>Emergency Contact 3:</label>
        <input type="text" name="emergency_contact_3" value="{{ old('emergency_contact_3', $user->emergency_contact_3) }}"><br>

        <button type="submit" class="btn btn-primary mt-2">Update Profile</button>
    </form>
</div>
@endsection