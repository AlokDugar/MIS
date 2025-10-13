@extends('layouts.dashboard')

@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h3>MIS - Admin Panel</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">MIS - Admin Panel</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>

            {{-- Summary Cards --}}
            <div class="row">
                <div class="col-4 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Total Menus
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold">{{ $totalMenus ?? 12 }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-bars fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-4 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        Clubs
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold">{{ $totalClubs ?? 5 }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-4 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Contact Lists
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold">{{ $totalContactLists ?? 215 }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-address-book fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Quick Action Buttons --}}
            <div class="row">
                <div class="col-md-4 col-sm-6 mb-3">
                    <a href="{{ route('menus.index') }}" class="btn btn-warning btn-icon-split btn-lg">
                        <span class="icon"><i class="fas fa-bars"></i></span>
                        <span class="text">Manage Menus</span>
                    </a>
                </div>

                <div class="col-md-4 col-sm-6 mb-3">
                    <a href="#" class="btn btn-info btn-icon-split btn-lg">
                        <span class="icon"><i class="fas fa-users"></i></span>
                        <span class="text">Manage Clubs</span>
                    </a>
                </div>

                <div class="col-md-4 col-sm-6 mb-3">
                    <a href="{{ route('contact-lists.index') }}" class="btn btn-success btn-icon-split btn-lg">
                        <span class="icon"><i class="fas fa-envelope"></i></span>
                        <span class="text">Read Enquiries</span>
                    </a>
                </div>
            </div>
        </div>

        {{-- Recent Events Table --}}
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Recent Events</h4>
                        <a href="#" class="btn btn-sm btn-primary">View All</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Action</th>
                                        <th>Module</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>John Doe</td>
                                        <td>Added Menu</td>
                                        <td>Menus</td>
                                        <td>Oct 10, 2025</td>
                                    </tr>
                                    <tr>
                                        <td>Mary Smith</td>
                                        <td>Updated Contact Info</td>
                                        <td>Contact Info</td>
                                        <td>Oct 9, 2025</td>
                                    </tr>
                                    <tr>
                                        <td>Ali Khan</td>
                                        <td>Added Contact List</td>
                                        <td>Contact Lists</td>
                                        <td>Oct 8, 2025</td>
                                    </tr>
                                    <tr>
                                        <td>Jane Doe</td>
                                        <td>Created Club</td>
                                        <td>Clubs</td>
                                        <td>Oct 7, 2025</td>
                                    </tr>
                                    <tr>
                                        <td>Mike Johnson</td>
                                        <td>Updated Committee</td>
                                        <td>Committees</td>
                                        <td>Oct 6, 2025</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
@endsection
