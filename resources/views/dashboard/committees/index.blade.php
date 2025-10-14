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
                        <h3>Committees</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">MIS - Admin Panel</a></li>
                            <li class="breadcrumb-item active">Committees</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                                <h4 class="mb-0">Committees Table</h4>
                                <form action="{{ route('committees.create') }}" method="GET">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-plus"></i> Add Committee
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
                                                <th>Established</th>
                                                <th>Description</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($committees as $committee)
                                                <tr>
                                                    <td>{{ $committee->id }}</td>
                                                    <td>{{ $committee->name }}</td>
                                                    <td>
                                                        <img src="{{ $committee->logo && file_exists(storage_path('app/public/' . $committee->logo))
                                                            ? asset('storage/' . $committee->logo)
                                                            : asset('assets/images/no-image.jpg') }}"
                                                            alt="Committee Logo" width="100" height="100">
                                                    </td>
                                                    <td>{{ $committee->established_date ? \Carbon\Carbon::parse($committee->established_date)->format('d M Y') : 'N/A' }}
                                                    </td>
                                                    <td>
                                                        {!! Str::limit(strip_tags($committee->description), 50) !!}
                                                    </td>
                                                    <td>
                                                        <ul class="action">
                                                            <li class="edit">
                                                                <a href="{{ route('committees.edit', $committee->id) }}">
                                                                    <i data-feather="edit"></i>
                                                                </a>
                                                            </li>
                                                            <li class="delete">
                                                                <a href="javascript:void(0);" class="delete-btn"
                                                                    data-id="{{ $committee->id }}">
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
                const committeeId = e.currentTarget.getAttribute('data-id');

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
                        form.action = '/committees/' + committeeId;

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
