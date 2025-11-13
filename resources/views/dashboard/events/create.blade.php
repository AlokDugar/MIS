@extends('layouts.dashboard')
@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>Add Event</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">MIS - Admin Panel</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('/events') }}">Events</a></li>
                            <li class="breadcrumb-item active">Add Event</li>
                        </ol>
                    </div>
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

                                <!-- Name -->
                                <div class="mb-3">
                                    <label class="form-label">Event Name *</label>
                                    <input type="text" name="name" value="{{ old('name') }}"
                                        class="form-control @error('name') is-invalid @enderror">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Image -->
                                <div class="mb-3">
                                    <label class="form-label">Event Image</label>
                                    <div class="d-flex align-items-center">
                                        <img id="image-preview" src="{{ asset('assets/images/upload.png') }}"
                                            class="img-100 me-3">
                                        <input type="file" name="image_path" id="event_image"
                                            onchange="previewImage(event)">
                                        <button type="button" class="btn btn-danger ms-3"
                                            onclick="removeImage()">Remove</button>
                                    </div>
                                </div>

                                <!-- Time, Location, Attendees, Status, Category -->
                                <div class="mb-3">
                                    <label>Time</label>
                                    <input type="text" name="time" value="{{ old('time') }}" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label>Location</label>
                                    <input type="text" name="location" value="{{ old('location') }}"
                                        class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label>Attendees</label>
                                    <input type="number" name="attendees" value="{{ old('attendees') }}"
                                        class="form-control" min="0">
                                </div>
                                <div class="mb-3">
                                    <label>Status</label>
                                    <select name="status" class="form-select">
                                        <option value="upcoming" {{ old('status') == 'upcoming' ? 'selected' : '' }}>
                                            Upcoming
                                        </option>
                                        <option value="ongoing" {{ old('status') == 'ongoing' ? 'selected' : '' }}>Ongoing
                                        </option>
                                        <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>
                                            Completed</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label>Category</label>
                                    <input type="text" name="category" value="{{ old('category') }}"
                                        class="form-control">
                                </div>

                                <!-- Tags -->
                                <div class="mb-3">
                                    <label>Event Tags</label>
                                    <select name="tag_ids[]" class="form-select" multiple>
                                        @foreach ($tags as $tag)
                                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Description -->
                                <div class="mb-3">
                                    <label>Description</label>
                                    <textarea name="description" id="editor" class="form-control">{{ old('description') }}</textarea>
                                </div>

                                <div class="text-end">
                                    <a href="{{ route('events.index') }}" class="btn btn-secondary">Cancel</a>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor.create(document.querySelector('#editor'), {
            ckfinder: {
                uploadUrl: "{{ route('events.upload', ['_token' => csrf_token()]) }}"
            }
        }).catch(error => {
            console.error(error)
        });

        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = e => document.getElementById('image-preview').src = e.target.result;
            reader.readAsDataURL(event.target.files[0]);
        }

        function removeImage() {
            document.getElementById('image-preview').src = "{{ asset('assets/images/upload.png') }}";
            document.getElementById('event_image').value = '';
        }
    </script>
@endpush
