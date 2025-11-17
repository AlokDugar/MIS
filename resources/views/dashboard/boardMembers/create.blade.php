@extends('layouts.dashboard')
@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h4>Add Board Member</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('board.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                        </div>
                        <div class="mb-3">
                            <label>Position</label>
                            <input type="text" name="position" class="form-control" value="{{ old('position') }}"
                                required>
                        </div>
                        <div class="mb-3">
                            <label>Bio</label>
                            <textarea name="bio" class="form-control">{{ old('bio') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label>Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-success">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
