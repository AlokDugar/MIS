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
                                    <input type="text" name="name" value="{{ old('name', $committee->name) }}"
                                        class="form-control @error('name') is-invalid @enderror"
                                        placeholder="Enter committee name">
                                    @error('name')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" value="{{ old('email', $committee->email) }}"
                                        class="form-control @error('email') is-invalid @enderror" placeholder="Enter email">
                                    @error('email')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Members -->
                                <div class="mb-3">
                                    <label class="form-label">Number of Members</label>
                                    <input type="number" name="members" value="{{ old('members', $committee->members) }}"
                                        class="form-control @error('members') is-invalid @enderror"
                                        placeholder="Enter members count">
                                    @error('members')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Established Date -->
                                <div class="mb-3">
                                    <label class="form-label">Established Date *</label>
                                    <input type="date" name="established_date"
                                        value="{{ old('established_date', $committee->established_date) }}"
                                        class="form-control @error('established_date') is-invalid @enderror">
                                    @error('established_date')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Committee Logo -->
                                <div class="mb-3">
                                    <label class="form-label">Committee Logo</label>
                                    <div class="d-flex align-items-center">
                                        <div class="p-image">
                                            <img id="logo-preview"
                                                src="{{ $committee->logo ? asset('storage/' . $committee->logo) : asset('assets/images/upload.png') }}"
                                                class="img-100 square profile-pic" alt="Logo Preview">
                                            <div class="icon-wrapper">
                                                <i class="fas fa-plus"
                                                    onclick="document.getElementById('logo').click();"></i>
                                                <input type="file" id="logo" name="logo" accept="image/*"
                                                    style="display:none;" onchange="previewLogo(event)">
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-danger btn-sm ms-4"
                                            onclick="removeLogo()">Remove Logo</button>
                                    </div>
                                </div>

                                <!-- Description -->
                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" id="editor" class="ckeditor form-control">{{ old('description', $committee->description) }}</textarea>
                                </div>

                                <!-- Responsibilities -->
                                <div class="mb-3">
                                    <label class="form-label">Responsibilities</label>
                                    <div id="responsibilities-wrapper">
                                        @if (old('responsibilities', $committee->responsibilities))
                                            @foreach (old('responsibilities', json_decode($committee->responsibilities, true)) as $responsibility)
                                                <div class="responsibility-row d-flex mb-2">
                                                    <input type="text" name="responsibilities[]"
                                                        class="form-control me-2" value="{{ $responsibility }}"
                                                        placeholder="Responsibility">
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        onclick="removeRow(this)">Remove</button>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="responsibility-row d-flex mb-2">
                                                <input type="text" name="responsibilities[]" class="form-control me-2"
                                                    placeholder="Responsibility">
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
                                        @if (old('achievements', $committee->achievements))
                                            @foreach (old('achievements', json_decode($committee->achievements, true)) as $achievement)
                                                <div class="achievement-row d-flex mb-2">
                                                    <input type="text" name="achievements[]" class="form-control me-2"
                                                        value="{{ $achievement }}" placeholder="Achievement">
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        onclick="removeRow(this)">Remove</button>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="achievement-row d-flex mb-2">
                                                <input type="text" name="achievements[]" class="form-control me-2"
                                                    placeholder="Achievement">
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
                                    <input type="text" name="meetings"
                                        value="{{ old('meetings', $committee->meetings) }}" class="form-control"
                                        placeholder="Meeting schedule">
                                </div>

                                <!-- Impact Score -->
                                <div class="mb-3">
                                    <label class="form-label">Impact Score</label>
                                    <input type="number" step="0.1" min="0" max="9.9"
                                        name="impact_score" value="{{ old('impact_score', $committee->impact_score) }}"
                                        class="form-control" placeholder="Impact score">
                                </div>

                                <!-- Chair -->
                                <div class="mb-3">
                                    <label class="form-label">Chair</label>
                                    <input type="text" name="chair" value="{{ old('chair', $committee->chair) }}"
                                        class="form-control" placeholder="Chair name">
                                    @error('chair')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="text-end mt-4">
                                    <button type="button" class="btn btn-secondary me-2"
                                        onclick="window.location='{{ route('committees.index') }}'">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
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
                ClassicEditor.create(document.querySelector('#editor')).catch(console.error);

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
                }

                function addResponsibility() {
                    const wrapper = document.getElementById('responsibilities-wrapper');
                    const div = document.createElement('div');
                    div.classList.add('responsibility-row', 'd-flex', 'mb-2');
                    div.innerHTML =
                        `<input type="text" name="responsibilities[]" class="form-control me-2" placeholder="Responsibility">
                                 <button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">Remove</button>`;
                    wrapper.appendChild(div);
                }

                function addAchievement() {
                    const wrapper = document.getElementById('achievements-wrapper');
                    const div = document.createElement('div');
                    div.classList.add('achievement-row', 'd-flex', 'mb-2');
                    div.innerHTML =
                        `<input type="text" name="achievements[]" class="form-control me-2" placeholder="Achievement">
                                 <button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">Remove</button>`;
                    wrapper.appendChild(div);
                }

                function removeRow(btn) {
                    btn.parentElement.remove();
                }
            </script>
        @endpush
    @endsection
