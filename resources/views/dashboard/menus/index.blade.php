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
                        <h3>Menus</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">MIS - Admin Dashboard</a></li>
                            <li class="breadcrumb-item active">Menus</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Menus Table</h4>
                            <a href="{{ route('menus.create') }}" class="btn btn-primary">Add Menu</a>
                        </div>
                        <div class="card-body">
                            <div class="dt-ext table-responsive theme-scrollbar">
                                <table class="display keytable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>URL</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($menus as $menu)
                                            <tr>
                                                <td>{{ $menu->id }}</td>
                                                <td>{{ $menu->name }}</td>
                                                <td>{{ $menu->url }}</td>
                                                <td>
                                                    <form action="{{ route('menus.updateStatus') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                                                        <a type="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            <span
                                                                class="badge status-info
                                                                @if ($menu->status == 'Active') bg-success
                                                                @else
                                                                    bg-danger @endif"
                                                                data-menu-id="{{ $menu->id }}"
                                                                data-current-status="{{ $menu->status }}">
                                                                {{ $menu->status }}
                                                            </span>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-end status-dropdown-menu">
                                                            <button type="submit" class="dropdown-item" name="status"
                                                                value="Active">
                                                                <i class="fas fa-check-circle status-icon active-icon"
                                                                    style="color: rgb(85, 255, 0);"></i> Active
                                                            </button>
                                                            <button type="submit" class="dropdown-item" name="status"
                                                                value="Inactive">
                                                                <i class="fas fa-times-circle status-icon inactive-icon"
                                                                    style="color: rgb(255, 0, 0);"></i> Inactive
                                                            </button>
                                                        </div>
                                                    </form>
                                                </td>
                                                <td>
                                                    <ul class="action d-flex gap-2">
                                                        <li class="edit">
                                                            <a href="{{ route('menus.edit', $menu->id) }}" title="Edit">
                                                                <i data-feather="edit"></i>
                                                            </a>
                                                        </li>
                                                        <li class="delete">
                                                            <a href="javascript:void(0);" class="delete-btn"
                                                                data-id="{{ $menu->id }}">
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

    <form id="delete-form" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
@endsection

@push('scripts')
    <script>
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                const menuId = this.getAttribute('data-id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'This menu will be deleted!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        const form = document.getElementById('delete-form');
                        form.setAttribute('action', '/menus/' + menuId);
                        form.submit();
                    }
                });
            });
        });
    </script>
@endpush
