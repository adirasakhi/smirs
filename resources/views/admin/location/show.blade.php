@extends('layouts.app')

@section('content')
    <h1>{{ $location->name }}</h1>

    <p>Inventories at this location:</p>
    <ul>
        @foreach ($location->inventories as $inventory)
            <li>{{ $inventory->name }} (Quantity: {{ $inventory->pivot->quantity }})</li>
        @endforeach
    </ul>

    <a href="{{ route('admin.locations.edit', $location->id) }}" class="btn btn-warning">Edit</a>
    <form action="{{ route('admin.locations.destroy', $location->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
    </form>
@endsection
