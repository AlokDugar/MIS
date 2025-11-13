@extends('layouts.dashboard')
@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>Edit Event</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">MIS - Admin Panel</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('/events') }}">Events</a></li>
                            <li class="breadcrumb-item active">Edit Event</li>
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
                            <form action="{{ route('events.update', $event->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf @method('PUT')

                                <!-- Name -->
                                <div class="mb-3">
                                    <label class="form-label">Event Name *</label>
                                    <input type="text" name="name" value="{{ old('name', $event->name) }}"
                                        class="form-control">
                                </div>

                                <!-- Image -->
                                <div class="mb-3">
                                    <label>Event Image</label>
                                    <div class="d-flex align-items-center">
                                        <img id="image-preview"
                                            src="{{ $event->image_path ? asset('storage/' . $event->image_path) : asset('assets/images/upload.png') }}"
                                            class="img-100 me-3">
                                        <input type="file" name="image_path" id="event_image"
                                            onchange="previewImage(event)">
                                        <button type="button" class="btn btn-danger ms-3"
                                            onclick="removeImage()">Remove</button>
                                        <input type="hidden" name="remove_image" id="remove-image-field" value="0">
                                    </div>
                                </div>

                                <!-- Time, Location, Attendees, Status, Category -->
                                <div class="mb-3"><label>Time</label>
                                    <input type="text" name="time" value="{{ old('time', $event->time) }}"
                                        class="form-control">
                                </div>
                                <div class="mb-3"><label>Location</label>
                                    <input type="text" name="location" value="{{ old('location', $event->location) }}"
                                        class="form-control">
                                </div>
                                <div class="mb-3"><label>Attendees</label>
                                    <input type="number" name="attendees" value="{{ old('attendees', $event->attendees) }}"
                                        class="form-control" min="0">
                                </div>
                                <div class="mb-3"><label>Status</label>
                                    <select name="status" class="form-select">
                                        <option value="upcoming"
                                            {{ old('status', $event->status) == 'upcoming' ? 'selected' : '' }}>Upcoming
                                        </option>
                                        <option value="ongoing"
                                            {{ old('status', $event->status) == 'ongoing' ? 'selected' : '' }}>Ongoing
                                        </option>
                                        <option value="completed"
                                            {{ old('status', $event->status) == 'completed' ? 'selected' : '' }}>Completed
                                        </option>
                                    </select>
                                </div>
                                <div class="mb-3"><label>Category</label>
                                    <input type="text" name="category" value="{{ old('category', $event->category) }}"
                                        class="form-control">
                                </div>

                                <!-- Tags -->
                                <div class="mb-3">
                                    <label>Event Tags</label>
                                    <select name="tag_ids[]" class="form-select" multiple>
                                        @foreach ($tags as $tag)
                                            <option value="{{ $tag->id }}"
                                                {{ in_array($tag->id, old('tag_ids', $event->tags->pluck('id')->toArray())) ? 'selected' : '' }}>
                                                {{ $tag->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Description -->
                                <div class="mb-3">
                                    <label>Description</label>
                                    <textarea name="description" id="editor" class="form-control">{{ old('description', $event->description) }}</textarea>
                                </div>

                                <div class="text-end">
                                    <a href="{{ route('events.index') }}" class="btn btn-secondary">Cancel</a>
                                    <button type="submit" class="btn btn-primary">Update</button>
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
        }).catch(error => console.error(error));

        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = e => document.getElementById('image-preview').src = e.target.result;
            reader.readAsDataURL(event.target.files[0]);
        }

        function removeImage() {
            document.getElementById('image-preview').src = "{{ asset('assets/images/upload.png') }}";
            document.getElementById('remove-image-field').value = '1';
            document.getElementById('event_image').value = '';
        }
    </script>
@endpush
