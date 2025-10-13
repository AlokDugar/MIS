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
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Events</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Events Table</h4>
                            <a href="{{ route('events.create') }}" class="btn btn-primary">Add Event</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive theme-scrollbar">
                                <table class="display keytable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Image</th>
                                            <th>Date</th>
                                            <th>Description</th>
                                            <th>Tags</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($events as $event)
                                            <tr>
                                                <td>{{ $event->id }}</td>
                                                <td>{{ $event->name }}</td>
                                                <td>
                                                    <img src="{{ $event->image && file_exists(storage_path('app/public/events/' . $event->image))
                                                        ? asset('storage/events/' . $event->image)
                                                        : asset('assets/images/no-image.jpg') }}"
                                                        alt="Event Image" width="100" height="100">
                                                </td>
                                                <td>{{ $event->date }}</td>
                                                <td>{{ Str::limit($event->description, 50) }}</td>
                                                <td>
                                                    @foreach ($event->tags as $tag)
                                                        <span class="badge badge-light-primary">{{ $tag->name }}</span>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <ul class="action d-flex gap-2">
                                                        <li class="edit">
                                                            <a href="{{ route('events.edit', $event->id) }}"><i
                                                                    data-feather="edit"></i></a>
                                                        </li>
                                                        <li class="delete">
                                                            <a href="javascript:void(0);" class="delete-btn"
                                                                data-id="{{ $event->id }}"><i
                                                                    data-feather="trash-2"></i></a>
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

        <form id="delete-form" method="POST" style="display:none;">
            @csrf
            @method('DELETE')
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                const eventId = this.getAttribute('data-id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "This event will be deleted!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        const form = document.getElementById('delete-form');
                        form.setAttribute('action', '/events/' + eventId);
                        form.submit();
                    }
                });
            });
        });
    </script>
@endpush
