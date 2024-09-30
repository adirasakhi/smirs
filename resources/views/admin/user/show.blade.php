@extends('layouts.app')

@section('content')
    <h1>User Details</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Name: {{ $user->name }}</h5>
            <p class="card-text"><strong>Email:</strong> {{ $user->email }}</p>
            <p class="card-text"><strong>Division:</strong> {{ $user->division }}</p>
            <p class="card-text"><strong>Phone:</strong> {{ $user->phone }}</p>
            <p class="card-text"><strong>Role:</strong> {{ $user->role->name ?? 'N/A' }}</p>
            @if($user->profile_photo)
                <p class="card-text"><strong>Profile Photo:</strong></p>
                <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="Profile Photo" class="img-fluid" style="max-width: 200px;">
            @endif
        </div>
    </div>

    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning">Edit</a>
    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
    </form>
@endsection
