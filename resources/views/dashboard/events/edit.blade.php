@extends('layouts.dashboard')
@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>Edit Event</h3>
                    </div>
                </div>
            </div>

            <div class="container-fluid px-0">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('events.update', $event->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="mb-3">
                                        <label class="form-label">Event Name *</label>
                                        <input type="text" name="name" class="form-control"
                                            value="{{ old('name', $event->name) }}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Image</label>
                                        <input type="file" name="image" class="form-control">
                                        @if ($event->image)
                                            <img src="{{ asset('storage/events/' . $event->image) }}" width="100"
                                                class="mt-2">
                                        @endif
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Date *</label>
                                        <input type="date" name="date" class="form-control"
                                            value="{{ old('date', $event->date) }}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea name="description" class="form-control">{{ old('description', $event->description) }}</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Tags</label>
                                        <select name="tags[]" class="form-control js-example-basic-multiple" multiple>
                                            @foreach ($tags as $tag)
                                                <option value="{{ $tag->id }}"
                                                    {{ in_array($tag->id, $event->tags->pluck('id')->toArray()) ? 'selected' : '' }}>
                                                    {{ $tag->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="text-end mt-4">
                                        <a href="{{ route('events.index') }}" class="btn btn-secondary me-2">Cancel</a>
                                        <button type="submit" class="btn btn-primary">Update</button>
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
