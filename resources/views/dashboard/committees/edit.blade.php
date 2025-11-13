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
                                    <label class="form-label">Committee Name *</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name', $committee->name) }}">
                                    @error('name')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email', $committee->email) }}">
                                    @error('email')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Members -->
                                <div class="mb-3">
                                    <label class="form-label">Number of Members</label>
                                    <input type="number" class="form-control @error('members') is-invalid @enderror"
                                        name="members" value="{{ old('members', $committee->members) }}">
                                    @error('members')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Established Date -->
                                <div class="mb-3">
                                    <label class="form-label">Established Date *</label>
                                    <input type="date"
                                        class="form-control @error('established_date') is-invalid @enderror"
                                        name="established_date"
                                        value="{{ old('established_date', $committee->established_date ? \Carbon\Carbon::parse($committee->established_date)->format('Y-m-d') : '') }}">
                                    @error('established_date')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Logo -->
                                <div class="mb-3">
                                    <label class="form-label">Committee Logo</label>
                                    <div class="d-flex align-items-center">
                                        <img id="logo-preview" class="img-100 square profile-pic"
                                            src="{{ $committee->logo ? asset('storage/' . $committee->logo) : asset('assets/images/upload.png') }}">
                                        <div class="ms-3">
                                            <i class="fas fa-plus" onclick="document.getElementById('logo').click();"></i>
                                            <input type="file" id="logo" name="logo" style="display:none;"
                                                accept="image/*" onchange="previewLogo(event)">
                                            <button type="button" class="btn btn-danger btn-sm mt-2"
                                                onclick="removeLogo()">Remove Logo</button>
                                            <input type="hidden" name="remove_logo" id="remove-logo-field" value="0">
                                        </div>
                                    </div>
                                </div>

                                <!-- Image -->
                                <div class="mb-3">
                                    <label class="form-label">Committee Image</label>
                                    <div class="d-flex align-items-center">
                                        <img id="image-preview" class="img-100 square profile-pic"
                                            src="{{ $committee->image ? asset('storage/' . $committee->image) : asset('assets/images/upload.png') }}">
                                        <div class="ms-3">
                                            <i class="fas fa-plus" onclick="document.getElementById('image').click();"></i>
                                            <input type="file" id="image" name="image" style="display:none;"
                                                accept="image/*" onchange="previewImage(event)">
                                            <button type="button" class="btn btn-danger btn-sm mt-2"
                                                onclick="removeImage()">Remove Image</button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Description -->
                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" id="editor" class="ckeditor rich-text-editor border p-2">{{ old('description', $committee->description) }}</textarea>
                                </div>

                                <!-- Long Description -->
                                <div class="mb-3">
                                    <label class="form-label">Long Description</label>
                                    <textarea name="long_description" class="form-control" rows="4">{{ old('long_description', $committee->long_description) }}</textarea>
                                </div>

                                <!-- Responsibilities -->
                                <div class="mb-3">
                                    <label class="form-label">Responsibilities</label>
                                    <div id="responsibilities-wrapper">
                                        @php
                                            $responsibilities = old(
                                                'responsibilities',
                                                $committee->responsibilities ?? [],
                                            );
                                        @endphp
                                        @foreach ($responsibilities as $responsibility)
                                            <div class="d-flex mb-2">
                                                <input type="text" name="responsibilities[]" class="form-control me-2"
                                                    value="{{ $responsibility }}">
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    onclick="removeRow(this)">Remove</button>
                                            </div>
                                        @endforeach
                                        @if (count($responsibilities) == 0)
                                            <div class="d-flex mb-2">
                                                <input type="text" name="responsibilities[]"
                                                    class="form-control me-2">
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    onclick="removeRow(this)">Remove</button>
                                            </div>
                                        @endif
                                    </div>
                                    <button type="button" class="btn btn-primary btn-sm mt-2"
                                        onclick="addResponsibility()">Add Responsibility</button>
                                </div>

                                <!-- Achievements -->
                                <div class="mb-3">
                                    <label class="form-label">Achievements</label>
                                    <div id="achievements-wrapper">
                                        @php
                                            $achievements = old('achievements', $committee->achievements ?? []);
                                        @endphp
                                        @foreach ($achievements as $achievement)
                                            <div class="d-flex mb-2">
                                                <input type="text" name="achievements[]" class="form-control me-2"
                                                    value="{{ $achievement }}">
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    onclick="removeRow(this)">Remove</button>
                                            </div>
                                        @endforeach
                                        @if (count($achievements) == 0)
                                            <div class="d-flex mb-2">
                                                <input type="text" name="achievements[]" class="form-control me-2">
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    onclick="removeRow(this)">Remove</button>
                                            </div>
                                        @endif
                                    </div>
                                    <button type="button" class="btn btn-primary btn-sm mt-2"
                                        onclick="addAchievement()">Add Achievement</button>
                                </div>

                                <!-- Meetings -->
                                <div class="mb-3">
                                    <label class="form-label">Meetings</label>
                                    <input type="text" class="form-control" name="meetings"
                                        value="{{ old('meetings', $committee->meetings) }}">
                                </div>

                                <!-- Impact Score -->
                                <div class="mb-3">
                                    <label class="form-label">Impact Score</label>
                                    <input type="number" step="0.1" min="0" max="9.9"
                                        class="form-control" name="impact_score"
                                        value="{{ old('impact_score', $committee->impact_score) }}">
                                </div>

                                <!-- Positions -->
                                <div class="mb-3">
                                    <label class="form-label">Positions</label>
                                    <div id="positions-wrapper">
                                        @foreach (old('positions', $committee->positions ?? []) as $index => $position)
                                            <div class="position-row d-flex align-items-center mb-2">
                                                <input type="text"
                                                    name="positions[{{ $index }}][position_name]"
                                                    value="{{ $position['position_name'] ?? $position->position_name }}"
                                                    placeholder="Position Name" class="form-control me-2">
                                                <input type="text" name="positions[{{ $index }}][holder_name]"
                                                    value="{{ $position['holder_name'] ?? $position->holder_name }}"
                                                    placeholder="Position Holder" class="form-control me-2">
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    onclick="removePosition(this)">Remove</button>
                                            </div>
                                        @endforeach
                                    </div>
                                    <button type="button" class="btn btn-primary btn-sm mt-2"
                                        onclick="addPosition()">Add Position</button>
                                </div>

                                <!-- Submit -->
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
            ClassicEditor.create(document.querySelector('#editor')).catch(e => console.error(e));

            function previewLogo(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = e => document.getElementById('logo-preview').src = e.target.result;
                    reader.readAsDataURL(file);
                }
            }

            function removeLogo() {
                document.getElementById('logo-preview').src = "{{ asset('assets/images/upload.png') }}";
                document.getElementById('logo').value = "";
                document.getElementById('remove-logo-field').value = '1';
            }

            function previewImage(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = e => document.getElementById('image-preview').src = e.target.result;
                    reader.readAsDataURL(file);
                }
            }

            function removeImage() {
                document.getElementById('image-preview').src = "{{ asset('assets/images/upload.png') }}";
                document.getElementById('image').value = "";
            }

            let positionIndex = {{ count(old('positions', $committee->positions ?? [])) }};

            function addPosition() {
                const wrapper = document.getElementById('positions-wrapper');
                const div = document.createElement('div');
                div.classList.add('position-row', 'd-flex', 'align-items-center', 'mb-2');
                div.innerHTML =
                    `<input type="text" name="positions[${positionIndex}][position_name]" placeholder="Position Name" class="form-control me-2"><input type="text" name="positions[${positionIndex}][holder_name]" placeholder="Position Holder" class="form-control me-2"><button type="button" class="btn btn-danger btn-sm" onclick="removePosition(this)">Remove</button>`;
                wrapper.appendChild(div);
                positionIndex++;
            }

            function removePosition(button) {
                button.parentElement.remove();
            }

            function addResponsibility() {
                const wrapper = document.getElementById('responsibilities-wrapper');
                const div = document.createElement('div');
                div.classList.add('d-flex', 'mb-2');
                div.innerHTML =
                    `<input type="text" name="responsibilities[]" class="form-control me-2" placeholder="Responsibility"><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">Remove</button>`;
                wrapper.appendChild(div);
            }

            function addAchievement() {
                const wrapper = document.getElementById('achievements-wrapper');
                const div = document.createElement('div');
                div.classList.add('d-flex', 'mb-2');
                div.innerHTML =
                    `<input type="text" name="achievements[]" class="form-control me-2" placeholder="Achievement"><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">Remove</button>`;
                wrapper.appendChild(div);
            }

            function removeRow(button) {
                button.parentElement.remove();
            }
        </script>
    @endpush
