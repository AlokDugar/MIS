@extends('layouts.dashboard')

@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center justify-content-between"
                        role="alert">
                        <span>{{ session('success') }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="row">
                    <div class="col-sm-6">
                        <h3>Clubs</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">MIS - Admin Panel</a></li>
                            <li class="breadcrumb-item active">Clubs</li>
                            <li class="breadcrumb-item active">Club Details</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                                <h4 class="mb-0">Clubs Table</h4>
                                <form action="{{ route('clubs.create') }}" method="GET">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-plus"></i> Add Club
                                    </button>
                                </form>
                            </div>
                            <div class="card-body">
                                <div class="dt-ext table-responsive theme-scrollbar">
                                    <table class="display keytable">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Logo</th>
                                                <th>President</th>
                                                <th>Members</th>
                                                <th>Established</th>
                                                <th>Tags</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($clubs as $club)
                                                <tr>
                                                    <td>{{ $club->id }}</td>
                                                    <td>{{ $club->name }}</td>
                                                    <td>
                                                        <img src="{{ $club->logo && file_exists(storage_path('app/public/' . $club->logo))
                                                            ? asset('storage/' . $club->logo)
                                                            : asset('assets/images/no-image.jpg') }}"
                                                            alt="Club Logo" width="100" height="100">
                                                    </td>
                                                    <td>{{ $club->president }}</td>
                                                    <td>{{ $club->members }}</td>
                                                    <td>{{ $club->established_date ? \Carbon\Carbon::parse($club->established_date)->format('d M Y') : 'N/A' }}
                                                    </td>
                                                    <td>
                                                        @foreach ($club->tags as $tag)
                                                            <span
                                                                class="badge badge-light-primary">{{ $tag->name }}</span>
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        <ul class="action">
                                                            <li class="edit">
                                                                <a href="{{ route('clubs.edit', $club->id) }}">
                                                                    <i data-feather="edit"></i>
                                                                </a>
                                                            </li>
                                                            <li class="delete">
                                                                <a href="javascript:void(0);" class="delete-btn"
                                                                    data-id="{{ $club->id }}">
                                                                    <i data-feather="trash-2"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                const clubId = e.currentTarget.getAttribute('data-id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = '/clubs/' + clubId;

                        const methodField = document.createElement('input');
                        methodField.type = 'hidden';
                        methodField.name = '_method';
                        methodField.value = 'DELETE';
                        form.appendChild(methodField);

                        const csrfToken = document.createElement('input');
                        csrfToken.type = 'hidden';
                        csrfToken.name = '_token';
                        csrfToken.value = '{{ csrf_token() }}';
                        form.appendChild(csrfToken);

                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            });
        });
    </script>
@endpush
