@extends('layouts.dashboard')
@section('content')
    <div class="page-body">
        <div class="container-fluid">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Gallery</h4>
                    <a href="{{ route('galleries.create') }}" class="btn btn-primary">Add Gallery</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Date</th>
                                <th>Attendees</th>
                                <th>Image</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($galleries as $gallery)
                                <tr>
                                    <td>{{ $gallery->id }}</td>
                                    <td>{{ $gallery->title }}</td>
                                    <td>{{ $gallery->date }}</td>
                                    <td>{{ $gallery->attendees }}</td>
                                    <td>
                                        <img src="{{ $gallery->image ? asset('storage/' . $gallery->image) : asset('assets/images/no-image.jpg') }}"
                                            width="100" alt="Gallery Image">
                                    </td>
                                    <td>
                                        <a href="{{ route('galleries.edit', $gallery->id) }}"
                                            class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('galleries.destroy', $gallery->id) }}" method="POST"
                                            class="d-inline-block" onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
