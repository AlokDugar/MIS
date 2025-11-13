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
                        <h3>Events</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">MIS - Admin Panel</a></li>
                            <li class="breadcrumb-item active">Events</li>
                            <li class="breadcrumb-item active">Event Details</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                                <h4 class="mb-0">Events Table</h4>
                                <a href="{{ route('events.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Add Event
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive theme-scrollbar">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Image</th>
                                                <th>Date</th>
                                                <th>Time</th>
                                                <th>Location</th>
                                                <th>Attendees</th>
                                                <th>Status</th>
                                                <th>Category</th>
                                                <th>Tags</th>
                                                <th>Description</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($events as $event)
                                                <tr>
                                                    <td>{{ $event->id }}</td>
                                                    <td>{{ $event->name }}</td>
                                                    <td>
                                                        <img src="{{ $event->image_path && file_exists(storage_path('app/public/' . $event->image_path))
                                                            ? asset('storage/' . $event->image_path)
                                                            : asset('assets/images/no-image.jpg') }}"
                                                            alt="Event Image" width="100" height="100">
                                                    </td>
                                                    <td>{{ $event->date ? $event->date->format('d M Y') : 'N/A' }}</td>
                                                    <td>{{ $event->time ?? 'N/A' }}</td>
                                                    <td>{{ $event->location ?? 'N/A' }}</td>
                                                    <td>{{ $event->attendees ?? 'N/A' }}</td>
                                                    <td>{{ ucfirst($event->status) ?? 'N/A' }}</td>
                                                    <td>{{ $event->category ?? 'N/A' }}</td>
                                                    <td>
                                                        @foreach ($event->categories as $tag)
                                                            <span class="badge bg-primary">{{ $tag->name }}</span>
                                                        @endforeach
                                                    </td>
                                                    <td>{!! Str::limit(strip_tags($event->description), 50) !!}</td>
                                                    <td>
                                                        <ul class="action list-unstyled d-flex gap-2 mb-0">
                                                            <li>
                                                                <a href="{{ route('events.edit', $event->id) }}"
                                                                    class="btn btn-sm btn-warning">
                                                                    <i data-feather="edit"></i>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0);"
                                                                    class="btn btn-sm btn-danger delete-btn"
                                                                    data-id="{{ $event->id }}">
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
        // Initialize Feather Icons
        feather.replace();

        // SweetAlert Delete
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                const eventId = e.currentTarget.getAttribute('data-id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This action cannot be undone!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = '/events/' + eventId;

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
