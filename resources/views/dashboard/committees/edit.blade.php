@extends('layouts.dashboard')
@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>Edit Committee</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">MIS - Admin Panel</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('/committees') }}">Committees</a></li>
                            <li class="breadcrumb-item active">Edit Committee</li>
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
                            <form action="{{ route('committees.update', $committee->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <!-- Committee Name -->
                                <div class="mb-3">
                                    <label for="name" class="form-label">Committee Name *</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" id="name" value="{{ old('name', $committee->name) }}">
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
                                                src="{{ $committee->logo && file_exists(storage_path('app/public/' . $committee->logo))
                                                    ? asset('storage/' . $committee->logo)
                                                    : asset('assets/images/upload.png') }}"
                                                alt="Logo Preview">
                                            <div class="icon-wrapper">
                                                <i class="fas fa-plus"
                                                    onclick="document.getElementById('logo').click();"></i>
                                                <input class="file-upload" id="logo" type="file" name="logo"
                                                    accept="image/*" style="display:none;" onchange="previewLogo(event)" />
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-danger btn-sm mt-2 ms-4"
                                            onclick="removeLogo()">Remove Logo</button>
                                        <input type="hidden" name="remove_logo" id="remove-logo-field" value="0">
                                    </div>
                                </div>

                                <!-- Established Date -->
                                <div class="mb-3">
                                    <label for="established_date" class="form-label">Established Date *</label>
                                    <input type="date"
                                        class="form-control @error('established_date') is-invalid @enderror"
                                        name="established_date"
                                        value="{{ old('established_date', $committee->established_date ? \Carbon\Carbon::parse($committee->established_date)->format('Y-m-d') : '') }}">
                                    @error('established_date')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Committee Description -->
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea name="description" id="editor" class="ckeditor rich-text-editor border p-2">{{ old('description', $committee->description) }}</textarea>
                                </div>

                                <!-- Committee Positions -->
                                <div class="mb-3">
                                    <label class="form-label">Positions</label>
                                    <div id="positions-wrapper">
                                        @if (old('positions'))
                                            @foreach (old('positions') as $index => $position)
                                                <div class="position-row d-flex align-items-center mb-2">
                                                    <input type="text"
                                                        name="positions[{{ $index }}][position_name]"
                                                        value="{{ $position['position_name'] }}"
                                                        placeholder="Position Name" class="form-control me-2">
                                                    <input type="text"
                                                        name="positions[{{ $index }}][holder_name]"
                                                        value="{{ $position['holder_name'] }}"
                                                        placeholder="Position Holder" class="form-control me-2">
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        onclick="removePosition(this)">Remove</button>
                                                </div>
                                            @endforeach
                                        @elseif($committee->positions)
                                            @foreach ($committee->positions as $index => $position)
                                                <div class="position-row d-flex align-items-center mb-2">
                                                    <input type="text"
                                                        name="positions[{{ $index }}][position_name]"
                                                        value="{{ $position->position_name }}" placeholder="Position Name"
                                                        class="form-control me-2">
                                                    <input type="text"
                                                        name="positions[{{ $index }}][holder_name]"
                                                        value="{{ $position->holder_name }}" placeholder="Position Holder"
                                                        class="form-control me-2">
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        onclick="removePosition(this)">Remove</button>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                    <button type="button" class="btn btn-primary btn-sm mt-2" onclick="addPosition()">Add
                                        Position</button>
                                </div>

                                <!-- Submit Buttons -->
                                <div class="text-end mt-4">
                                    <button type="button" class="btn btn-secondary me-2"
                                        onclick="window.location='{{ route('committees.index') }}'">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Update Committee</button>
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
            document.getElementById('remove-logo-field').value = '1';
        }

        let positionIndex = {{ $committee->positions ? $committee->positions->count() : 1 }};

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
