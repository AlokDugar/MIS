@extends('layouts.dashboard')
@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Gallery</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('galleries.update', $gallery->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control"
                                value="{{ old('title', $gallery->title) }}" required>
                        </div>
                        <div class="mb-3">
                            <label>Date</label>
                            <input type="text" name="date" class="form-control"
                                value="{{ old('date', $gallery->date) }}">
                        </div>
                        <div class="mb-3">
                            <label>Attendees</label>
                            <input type="text" name="attendees" class="form-control"
                                value="{{ old('attendees', $gallery->attendees) }}">
                        </div>
                        <div class="mb-3">
                            <label>Image</label>
                            <div class="mb-2">
                                <img id="image-preview"
                                    src="{{ $gallery->image ? asset('storage/' . $gallery->image) : asset('assets/images/no-image.jpg') }}"
                                    width="150" alt="Gallery Image">
                            </div>
                            <input type="file" name="image" class="form-control" onchange="previewImage(event)">
                            <input type="hidden" name="remove_image" id="remove-image-field" value="0">
                            <button type="button" class="btn btn-danger mt-2" onclick="removeImage()">Remove Image</button>
                        </div>
                        <button type="submit" class="btn btn-success">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = e => document.getElementById('image-preview').src = e.target.result;
            reader.readAsDataURL(event.target.files[0]);
        }

        function removeImage() {
            document.getElementById('image-preview').src = "{{ asset('assets/images/no-image.jpg') }}";
            document.getElementById('remove-image-field').value = 1;
        }
    </script>
@endpush
