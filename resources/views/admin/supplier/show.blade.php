@extends('layouts.app')

@section('content')
    <h1>{{ $supplier->name }}</h1>

    <p><strong>Phone:</strong> {{ $supplier->phone }}</p>
    <p><strong>Email:</strong> {{ $supplier->email }}</p>
    <p><strong>Address:</strong> {{ $supplier->address }}</p>

    <a href="{{ route('admin.suppliers.edit', $supplier->id) }}" class="btn btn-warning">Edit</a>
    <form action="{{ route('admin.suppliers.destroy', $supplier->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
    </form>
@endsection
