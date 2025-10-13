@extends('layouts.dashboard')
@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>Create Event</h3>
                    </div>
                </div>
            </div>

            <div class="container-fluid px-0">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Event Name *</label>
                                        <input type="text" name="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name') }}">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Image</label>
                                        <input type="file" name="image" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Date *</label>
                                        <input type="date" name="date"
                                            class="form-control @error('date') is-invalid @enderror"
                                            value="{{ old('date') }}">
                                        @error('date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Tags</label>
                                        <select name="tags[]" class="form-control js-example-basic-multiple" multiple>
                                            @foreach ($tags as $tag)
                                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="text-end mt-4">
                                        <a href="{{ route('events.index') }}" class="btn btn-secondary me-2">Cancel</a>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
