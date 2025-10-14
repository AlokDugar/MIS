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
                                    <label for="name" class="form-label">Event Name *</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" id="name" value="{{ old('name', $event->name) }}"
                                        placeholder="Enter Event Name">
                                    @error('name')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Event Image -->
                                <div class="mb-3">
                                    <label class="form-label">Image *</label>
                                    <div class="d-lg-flex d-md-flex d-sm-flex align-items-center">
                                        <div class="p-image">
                                            <img id="image-preview" class="img-100 square profile-pic"
                                                src="{{ $event->image_path ? asset('storage/event_images/' . basename($event->image_path)) : asset('assets/images/upload.png') }}"
                                                alt="Event Image">
                                            <div class="icon-wrapper">
                                                <i class="fas fa-plus"
                                                    onclick="document.getElementById('event_image').click();"></i>
                                                <input class="file-upload" id="event_image" type="file" name="image_path"
                                                    accept="image/*" style="display:none;" onchange="previewImage(event)" />
                                            </div>
                                        </div>
                                        <button type="button" id="remove-image" class="btn btn-danger btn-sm mt-2 ms-4"
                                            onclick="removeImage()">Remove Image</button>
                                        <input type="hidden" name="remove_image" id="remove-image-field" value="0">
                                    </div>
                                </div>

                                <!-- Event Tags -->
                                <div class="mb-3">
                                    <label class="form-label">Event Tags *</label>
                                    <select
                                        class="form-select js-example-basic-multiple @error('tag_ids') is-invalid @enderror"
                                        multiple="multiple" name="tag_ids[]" id="tags">
                                        @foreach ($tags as $tag)
                                            <option value="{{ $tag->id }}"
                                                {{ in_array($tag->id, old('tag_ids', $event->tags ? $event->tags->pluck('id')->toArray() : [])) ? 'selected' : '' }}>
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


                                <!-- Event Date -->
                                <div class="mb-3">
                                    <label class="form-label">Event Date *</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i data-feather="calendar"></i></span>
                                        <input class="form-control digits @error('date') is-invalid @enderror"
                                            type="date" name="date"
                                            value="{{ old('date', $event->date ? $event->date->format('Y-m-d') : '') }}">
                                    </div>
                                    @error('date')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Event Description -->
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea name="description" id="editor" class="ckeditor rich-text-editor border p-2">{{ old('description', $event->description) }}</textarea>
                                </div>

                                <div class="text-end mt-4">
                                    <button type="button" class="btn btn-secondary me-2"
                                        onclick="window.location='{{ route('events.index') }}'">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Update Event</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Tag Modal -->
        <div class="modal fade" id="createTagModal" tabindex="-1" aria-labelledby="createTagModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createTagModalLabel">Create Tag</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('event-tags.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="tagName" class="form-label">Tag Name</label>
                                <input type="text" class="form-control" id="tagName" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="tagStatus" class="form-label">Status</label>
                                <select class="form-select" name="status" id="tagStatus" required>
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
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
        ClassicEditor
            .create(document.querySelector('#editor'), {
                ckfinder: {
                    uploadUrl: "{{ route('events.upload', ['_token' => csrf_token()]) }}",
                }
            })
            .catch(error => {
                console.error(error);
            });

        function removeImage() {
            document.getElementById('image-preview').src = "{{ asset('assets/images/upload.png') }}";
            document.getElementById('remove-image-field').value = '1';
            document.getElementById('event_image').value = "";
        }

        function previewImage(event) {
            const file = event.target.files[0];
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('image-preview').src = e.target.result;
            };
            if (file) reader.readAsDataURL(file);
        }
    </script>
@endpush
