@extends('layouts.app')

@section('content')
    <h1>{{ $unit->name }}</h1>

    <a href="{{ route('admin.units.edit', $unit->id) }}" class="btn btn-warning">Edit</a>
    <form action="{{ route('admin.units.destroy', $unit->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
    </form>
@endsection
