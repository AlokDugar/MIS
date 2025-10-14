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
                        <h3>Contact Info</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">MIS - Admin Panel</a></li>
                            <li class="breadcrumb-item active">Contact Us</li>
                            <li class="breadcrumb-item active">Contact Info</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                                <h4 class="mb-0">Contact Infos Table</h4>
                                <a href="{{ $contactCount < 1 ? route('contact-infos.create') : '#' }}"
                                    class="btn btn-primary"
                                    title="{{ $contactCount >= 1 ? 'Only one contact record is allowed.' : '' }}">
                                    <i class="fas fa-plus"></i> Add Contact Info
                                </a>
                            </div>

                            <div class="card-body">
                                <div class="dt-ext table-responsive theme-scrollbar">
                                    <table class="display keytable">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($contactInfos as $info)
                                                <tr>
                                                    <td>{{ $info->id }}</td>
                                                    <td>{{ $info->email }}</td>
                                                    <td>{{ $info->phone ?? 'N/A' }}</td>
                                                    <td>
                                                        <ul class="action">
                                                            <li class="edit">
                                                                <a href="{{ route('contact-infos.edit', $info->id) }}">
                                                                    <i data-feather="edit"></i>
                                                                </a>
                                                            </li>
                                                            {{-- Delete button optional, uncomment if needed --}}
                                                            {{-- <li class="delete">
                                                            <a href="javascript:void(0);" class="delete-btn" data-id="{{ $info->id }}">
                                                                <i data-feather="trash-2"></i>
                                                            </a>
                                                        </li> --}}
                                                        </ul>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> {{-- card --}}
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
                const contactId = e.currentTarget.getAttribute('data-id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "This contact will be deleted!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = '/contact-infos/' + contactId;

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
