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
                                @csrf
                                @method('PUT')

                                <!-- Event Name -->
                                <div class="mb-3">
                                    <label class="form-label">Event Name *</label>
                                    <input type="text" name="name" value="{{ old('name', $event->name) }}"
                                        class="form-control @error('name') is-invalid @enderror"
                                        placeholder="Enter event name">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Event Image -->
                                <div class="mb-3">
                                    <label class="form-label">Event Image</label>
                                    <div class="d-lg-flex d-md-flex d-sm-flex align-items-center">
                                        <div class="p-image">
                                            <img id="image-preview" class="img-100 square profile-pic"
                                                src="{{ $event->image_path ? asset('storage/' . $event->image_path) : asset('assets/images/upload.png') }}"
                                                alt="Image Preview">
                                            <div class="icon-wrapper">
                                                <i class="fas fa-plus"
                                                    onclick="document.getElementById('event_image').click();"></i>
                                                <input class="file-upload" id="event_image" type="file" name="image_path"
                                                    accept="image/*" style="display:none;" onchange="previewImage(event)" />
                                            </div>
                                        </div>
                                        <button type="button" id="remove-image" class="btn btn-danger btn-sm mt-2 ms-4"
                                            onclick="removeImage()">Remove Image</button>
                                    </div>
                                </div>

                                <!-- Event Date -->
                                <div class="mb-3">
                                    <label class="form-label">Event Date *</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i data-feather="calendar"></i></span>
                                        <input type="date" name="date" value="{{ old('date', $event->date) }}"
                                            class="form-control @error('date') is-invalid @enderror">
                                    </div>
                                    @error('date')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Time -->
                                <div class="mb-3">
                                    <label class="form-label">Time</label>
                                    <input type="text" name="time" value="{{ old('time', $event->time) }}"
                                        class="form-control">
                                </div>

                                <!-- Location -->
                                <div class="mb-3">
                                    <label class="form-label">Location</label>
                                    <input type="text" name="location" value="{{ old('location', $event->location) }}"
                                        class="form-control">
                                </div>

                                <!-- Status -->
                                <div class="mb-3">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-select">
                                        <option value="Upcoming"
                                            {{ old('status', $event->status) == 'Upcoming' ? 'selected' : '' }}>
                                            Upcoming
                                        </option>
                                        <option value="Ongoing"
                                            {{ old('status', $event->status) == 'Ongoing' ? 'selected' : '' }}>
                                            Ongoing
                                        </option>
                                        <option value="Completed"
                                            {{ old('status', $event->status) == 'Completed' ? 'selected' : '' }}>
                                            Completed
                                        </option>
                                    </select>
                                </div>

                                <!-- Tags -->
                                <div class="mb-3">
                                    <label class="form-label">Event Tags *</label>
                                    <select
                                        class="form-select js-example-basic-multiple @error('tag_ids') is-invalid @enderror"
                                        multiple="multiple" name="tag_ids[]" id="tags">
                                        @foreach ($tags as $tag)
                                            <option value="{{ $tag->id }}"
                                                {{ in_array($tag->id, old('tag_ids', $event->tags->pluck('id')->toArray())) ? 'selected' : '' }}>
                                                {{ $tag->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('tag_ids')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror

                                    <button type="button" id="add-tag" class="btn btn-primary mt-3 text-white fw-bold"
                                        data-bs-toggle="modal" data-bs-target="#createTagModal">
                                        <i class="fa fa"></i> Add Tag
                                    </button>
                                </div>

                                <!-- Description -->
                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" id="editor" class="form-control">{{ old('description', $event->description) }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Submit -->
                                <div class="text-end">
                                    <a href="{{ route('events.index') }}" class="btn btn-secondary me-2">Cancel</a>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Create Tag Modal (same as create page) -->
        <div class="modal fade" id="createTagModal" tabindex="-1" aria-labelledby="createTagModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Create Event Tag</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('event-tags.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="tagName" class="form-label">Tag Name</label>
                                <input type="text" name="name" class="form-control" id="tagName" required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Create Tag</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>
        .ck-editor__editable_inline {
            min-height: 300px;
        }
    </style>
@endpush

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
            document.getElementById('event_image').value = '';
        }
    </script>
@endpush
