@extends('layouts.dashboard')
@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>Create Committee</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid px-0">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('committees.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <!-- Committee Name -->
                                <div class="mb-3">
                                    <label for="name" class="form-label">Committee Name *</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" id="name" placeholder="Enter committee name">
                                    @error('name')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Committee Logo -->
                                <div class="mb-3">
                                    <label class="form-label">Committee Logo</label>
                                    <div class="d-lg-flex d-md-flex d-sm-flex align-items-center">
                                        <div class="p-image">
                                            <img id="logo-preview" class="img-100 square profile-pic"
                                                src="{{ asset('assets/images/upload.png') }}" alt="Logo Preview">
                                            <div class="icon-wrapper">
                                                <i class="fas fa-plus"
                                                    onclick="document.getElementById('logo').click();"></i>
                                                <input class="file-upload" id="logo" type="file" name="logo"
                                                    accept="image/*" style="display:none;" onchange="previewLogo(event)" />
                                            </div>
                                        </div>
                                        <button type="button" id="remove-logo" class="btn btn-danger btn-sm mt-2 ms-4"
                                            onclick="removeLogo()">Remove Logo</button>
                                    </div>
                                </div>

                                <!-- Established Date -->
                                <div class="mb-3">
                                    <label for="established_date" class="form-label">Established Date *</label>
                                    <input type="date"
                                        class="form-control @error('established_date') is-invalid @enderror"
                                        name="established_date" value="{{ old('established_date') }}">
                                    @error('established_date')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Committee Description -->
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea name="description" id="editor" class="ckeditor rich-text-editor border p-2">{{ old('description') }}</textarea>
                                </div>

                                <!-- Committee Positions -->
                                <div class="mb-3">
                                    <label class="form-label">Positions</label>
                                    <div id="positions-wrapper">
                                        <div class="position-row d-flex align-items-center mb-2">
                                            <input type="text" name="positions[0][position_name]"
                                                placeholder="Position Name" class="form-control me-2">
                                            <input type="text" name="positions[0][holder_name]"
                                                placeholder="Position Holder" class="form-control me-2">
                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="removePosition(this)">Remove</button>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-primary btn-sm mt-2" onclick="addPosition()">Add
                                        Position</button>
                                </div>

                                <!-- Submit Buttons -->
                                <div class="text-end mt-4">
                                    <button type="button" class="btn btn-secondary me-2"
                                        onclick="window.location='{{ route('committees.index') }}'">Cancel</button>
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

@push('css')
    <style>
        .ck-editor__editable_inline {
            min-height: 200px;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });

        function previewLogo(event) {
            const file = event.target.files[0];
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('logo-preview').src = e.target.result;
            };
            if (file) reader.readAsDataURL(file);
        }

        function removeLogo() {
            document.getElementById('logo-preview').src = "{{ asset('assets/images/upload.png') }}";
            document.getElementById('logo').value = "";
        }

        let positionIndex = 1;

        function addPosition() {
            const wrapper = document.getElementById('positions-wrapper');
            const div = document.createElement('div');
            div.classList.add('position-row', 'd-flex', 'align-items-center', 'mb-2');
            div.innerHTML = `
            <input type="text" name="positions[${positionIndex}][position_name]" placeholder="Position Name" class="form-control me-2">
            <input type="text" name="positions[${positionIndex}][holder_name]" placeholder="Position Holder" class="form-control me-2">
            <button type="button" class="btn btn-danger btn-sm" onclick="removePosition(this)">Remove</button>
        `;
            wrapper.appendChild(div);
            positionIndex++;
        }

        function removePosition(button) {
            button.parentElement.remove();
        }
    </script>
@endpush
