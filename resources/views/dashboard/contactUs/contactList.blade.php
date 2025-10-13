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
                        <h3>Contact List</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">ERP Dashboard</a></li>
                            <li class="breadcrumb-item active">Contact Us</li>
                            <li class="breadcrumb-item active">Contact List</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                                <h4 class="mb-0">Contact Lists Table</h4>
                            </div>

                            {{-- Table --}}
                            <div class="card-body">
                                <div class="dt-ext table-responsive theme-scrollbar">
                                    <table class="display keytable">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Subject</th>
                                                <th>Message</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($contactLists as $info)
                                                <tr>
                                                    <td>{{ $info->id }}</td>
                                                    <td>{{ $info->name }}</td>
                                                    <td>{{ $info->email }}</td>
                                                    <td>{{ $info->phone ?? 'N/A' }}</td>
                                                    <td>{{ $info->subject }}</td>
                                                    <td>
                                                        <button class="btn btn-primary view-message-btn"
                                                            data-bs-toggle="modal" data-bs-target="#messageModal"
                                                            data-message="{{ $info->message }}">View Message</button>
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

        <!-- Modal for viewing message -->
        <div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="messageModalLabel">Message Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p id="modal-message-content">Loading message...</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.view-message-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const message = this.getAttribute('data-message');
                    // Replace line breaks with <br> for proper display
                    document.getElementById('modal-message-content').innerHTML = message.replace(
                        /\n/g, '<br>');
                });
            });
        });
    </script>
@endpush
