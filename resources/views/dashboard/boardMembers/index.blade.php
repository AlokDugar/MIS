@extends('layouts.dashboard')
@section('content')
    <div class="page-body">
        <div class="container-fluid">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Board Members</h4>
                    <a href="{{ route('board.create') }}" class="btn btn-primary">Add Member</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Image</th>
                                <th>Bio</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($members as $member)
                                <tr>
                                    <td>{{ $member->id }}</td>
                                    <td>{{ $member->name }}</td>
                                    <td>{{ $member->position }}</td>
                                    <td>
                                        <img src="{{ $member->image ? asset('storage/' . $member->image) : asset('assets/images/no-image.jpg') }}"
                                            width="100" alt="Member Image">
                                    </td>
                                    <td>{{ Str::limit($member->bio, 50) }}</td>
                                    <td>
                                        <a href="{{ route('board.edit', $member->id) }}"
                                            class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('board.destroy', $member->id) }}" method="POST"
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
