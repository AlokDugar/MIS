@extends('layouts.dashboard')
@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>Edit Club</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid px-0">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('clubs.update', $club->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <!-- Club Name -->
                                <div class="mb-3">
                                    <label for="name" class="form-label">Club Name *</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" id="name" value="{{ old('name', $club->name) }}"
                                        placeholder="Enter Club Name">
                                    @error('name')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Club Logo -->
                                <div class="mb-3">
                                    <label class="form-label">Club Logo *</label>
                                    <div class="d-lg-flex d-md-flex d-sm-flex align-items-center">
                                        <div class="p-image">
                                            <img id="logo-preview" class="img-100 square profile-pic"
                                                src="{{ $club->logo ? asset('storage/club_logos/' . basename($club->logo)) : asset('assets/images/upload.png') }}"
                                                alt="Club Logo">
                                            <div class="icon-wrapper">
                                                <i class="fas fa-plus"
                                                    onclick="document.getElementById('club_logo').click();"></i>
                                                <input class="file-upload" id="club_logo" type="file" name="logo"
                                                    accept="image/*" style="display:none;" onchange="previewLogo(event)" />
                                            </div>
                                        </div>
                                        <button type="button" id="remove-logo" class="btn btn-danger btn-sm mt-2 ms-4"
                                            onclick="removeLogo()">Remove Logo</button>
                                        <input type="hidden" name="remove_logo" id="remove-logo-field" value="0">
                                    </div>
                                </div>

                                <!-- President -->
                                <div class="mb-3">
                                    <label for="president" class="form-label">President *</label>
                                    <input type="text" class="form-control @error('president') is-invalid @enderror"
                                        name="president" id="president" value="{{ old('president', $club->president) }}"
                                        placeholder="Enter president name">
                                    @error('president')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Members -->
                                <div class="mb-3">
                                    <label for="members" class="form-label">Members</label>
                                    <input type="number" class="form-control @error('members') is-invalid @enderror"
                                        name="members" id="members" value="{{ old('members', $club->members) }}"
                                        placeholder="Enter number of members">
                                    @error('members')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Established Date -->
                                <div class="mb-3">
                                    <label for="established_date" class="form-label">Established Date</label>
                                    <input type="date"
                                        class="form-control @error('established_date') is-invalid @enderror"
                                        name="established_date"
                                        value="{{ old('established_date', $club->established_date ? $club->established_date->format('Y-m-d') : '') }}">
                                    @error('established_date')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Club Tags -->
                                <div class="mb-3">
                                    <label class="form-label">Tags *</label>
                                    <select
                                        class="form-select js-example-basic-multiple @error('tag_ids') is-invalid @enderror"
                                        multiple="multiple" name="tag_ids[]" id="tags">
                                        @foreach ($tags as $tag)
                                            <option value="{{ $tag->id }}"
                                                {{ in_array($tag->id, old('tag_ids', $club->tags ? $club->tags->pluck('id')->toArray() : [])) ? 'selected' : '' }}>
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

                                <!-- Submit Buttons -->
                                <div class="text-end mt-4">
                                    <button type="button" class="btn btn-secondary me-2"
                                        onclick="window.location='{{ route('clubs.index') }}'">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Update Club</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Create Tag Modal -->
        <div class="modal fade" id="createTagModal" tabindex="-1" aria-labelledby="createTagModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createTagModalLabel">Create Club Tag</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('club-tags.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="tagName" class="form-label">Tag Name</label>
                                <input type="text" class="form-control" id="tagName" name="name" required>
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

@push('scripts')
    <script>
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
            document.getElementById('remove-logo-field').value = '1';
            document.getElementById('club_logo').value = "";
        }
    </script>
@endpush
