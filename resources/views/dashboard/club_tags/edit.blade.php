@extends('layouts.dashboard')

@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>Edit Club Tag</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">MIS - Admin Panel</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('club-tags.index') }}">Club Tags</a></li>
                            <li class="breadcrumb-item active">Edit Tag</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h4 class="mb-0">Edit Club Tag</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('club-tags.update', $tag->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label class="form-label">Tag Name</label>
                                    <input type="text" name="name" class="form-control"
                                        value="{{ old('name', $tag->name) }}">
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="card-footer text-center">
                                    <button type="submit" class="btn btn-primary">Update Tag</button>
                                    <a href="{{ route('club-tags.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
