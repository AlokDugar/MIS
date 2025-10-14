@extends('layouts.dashboard')
@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>Add Club</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">MIS - Admin Panel</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('/clubs') }}">Clubs</a></li>
                            <li class="breadcrumb-item active">Add Club</li>
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
                            <form action="{{ route('clubs.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <!-- Club Name -->
                                <div class="mb-3">
                                    <label for="name" class="form-label">Club Name *</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" id="name" placeholder="Enter club name"
                                        value="{{ old('name') }}">
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
                                                src="{{ asset('assets/images/upload.png') }}" alt="Logo Preview">
                                            <div class="icon-wrapper">
                                                <i class="fas fa-plus"
                                                    onclick="document.getElementById('club_logo').click();"></i>
                                                <input class="file-upload" id="club_logo" type="file" name="logo"
                                                    accept="image/*" style="display:none;" onchange="previewLogo(event)" />
                                            </div>
                                        </div>
                                        <button type="button" id="remove-logo" class="btn btn-danger btn-sm mt-2 ms-4"
                                            onclick="removeLogo()">Remove Logo</button>
                                    </div>
                                </div>

                                <!-- President -->
                                <div class="mb-3">
                                    <label for="president" class="form-label">President *</label>
                                    <input type="text" class="form-control @error('president') is-invalid @enderror"
                                        name="president" id="president" placeholder="Enter president name"
                                        value="{{ old('president') }}">
                                    @error('president')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Members -->
                                <div class="mb-3">
                                    <label for="members" class="form-label">Members</label>
                                    <input type="number" class="form-control @error('members') is-invalid @enderror"
                                        name="members" id="members" placeholder="Enter number of members"
                                        value="{{ old('members') }}">
                                    @error('members')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Established Date -->
                                <div class="mb-3">
                                    <label for="established_date" class="form-label">Established Date</label>
                                    <input type="date"
                                        class="form-control @error('established_date') is-invalid @enderror"
                                        name="established_date" value="{{ old('established_date') }}">
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
                                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
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
                                        onclick="window.location='{{ route('clubs.index') }}'">
                                        Cancel
                                    </button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
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
            document.getElementById('club_logo').value = "";
        }
    </script>
@endpush
