@extends('layouts.dashboard')
@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Board Member</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('board.update', $member->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control"
                                value="{{ old('name', $member->name) }}" required>
                        </div>
                        <div class="mb-3">
                            <label>Position</label>
                            <input type="text" name="position" class="form-control"
                                value="{{ old('position', $member->position) }}" required>
                        </div>
                        <div class="mb-3">
                            <label>Bio</label>
                            <textarea name="bio" class="form-control ckeditor">{{ old('bio', $member->bio) }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label>Image</label>
                            <div class="mb-2">
                                <img id="image-preview"
                                    src="{{ $member->image ? asset('storage/' . $member->image) : asset('assets/images/no-image.jpg') }}"
                                    width="150" alt="Member Image">
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
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor.create(document.querySelector('.ckeditor')).catch(error => {
            console.error(error);
        });

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
