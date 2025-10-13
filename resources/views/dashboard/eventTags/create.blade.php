@extends('layouts.dashboard')

@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>Add Event Tag</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">MIS - Admin Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('event-tags.index') }}">Event Tags</a></li>
                            <li class="breadcrumb-item active">Add Tag</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h4 class="mb-0">Create Event Tag</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('event-tags.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Tag Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Enter tag name"
                                        value="{{ old('name') }}">
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="card-footer text-center">
                                    <button type="submit" class="btn btn-primary">Save Tag</button>
                                    <a href="{{ route('event-tags.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
