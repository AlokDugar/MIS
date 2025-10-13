@extends('layouts.dashboard')

@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h3>MIS - Admin Dashboard</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">MIS - Admin Dashboard</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-4 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        Total Clients</div>
                                    <div class="h5 mb-0 font-weight-bold">876</div>
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
                                        Monthly Revenue</div>
                                    <div class="h5 mb-0 font-weight-bold">$84,520</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-4 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Contact List Growth</div>
                                    <div class="h5 mb-0 font-weight-bold">2,143</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-address-book fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 col-sm-6 mb-3">
                    <a href="#" class="btn btn-info btn-icon-split btn-lg">
                        <span class="icon"><i class="fas fa-user-plus"></i></span>
                        <span class="text">Add Client</span>
                    </a>
                </div>

                <div class="col-md-4 col-sm-6 mb-3">
                    <a href="#" class="btn btn-success btn-icon-split btn-lg">
                        <span class="icon"><i class="fas fa-dollar-sign"></i></span>
                        <span class="text">Manage Subscription Plans</span>
                    </a>
                </div>

                <div class="col-md-4 col-sm-6 mb-3">
                    <a href="#" class="btn btn-warning btn-icon-split btn-lg">
                        <span class="icon"><i class="fas fa-envelope"></i></span>
                        <span class="text">Manage Contact Lists</span>
                    </a>
                </div>

            </div>

            <div class="row">
                <div class="col-6">
                    <div class="card shadow mb-4">
                        <div class="card-header pb-0">
                            <h4>Subscription Plans</h4>
                        </div>
                        <div class="card-body chart-block">
                            <div class="flot-chart-container">
                                <canvas id="subscriptionPlansChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="card shadow mb-4">
                        <div class="card-header pb-0">
                            <h4>Revenue Growth</h4>
                        </div>
                        <div class="card-body chart-block">
                            <div class="flot-chart-container">
                                <canvas id="revenueGrowthChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <div class="card-header pb-0">
                                <h4>Recent Subscription Activities</h4>
                            </div>
                            <a href="#" class="btn btn-sm btn-primary">View All</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Client Name</th>
                                            <th>Plan</th>
                                            <th>Start Date</th>
                                            <th>Amount</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Acme Corporation</td>
                                            <td>Enterprise</td>
                                            <td>Apr 20, 2025</td>
                                            <td>$1,200/mo</td>
                                            <td>
                                                <ul class="action">
                                                    <li class="edit">
                                                        <a href="#">
                                                            <i data-feather="edit"></i>
                                                        </a>
                                                    </li>
                                                    <li class="delete">
                                                        <a href="#" class="delete-btn">
                                                            <i data-feather="trash-2"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Smith Consulting</td>
                                            <td>Professional</td>
                                            <td>Apr 18, 2025</td>
                                            <td>$599/mo</td>
                                            <td>
                                                <ul class="action">
                                                    <li class="edit">
                                                        <a href="#">
                                                            <i data-feather="edit"></i>
                                                        </a>
                                                    </li>
                                                    <li class="delete">
                                                        <a href="#" class="delete-btn">
                                                            <i data-feather="trash-2"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Global Tech Ltd</td>
                                            <td>Enterprise</td>
                                            <td>Apr 15, 2025</td>
                                            <td>$1,200/mo</td>
                                            <td>
                                                <ul class="action">
                                                    <li class="edit">
                                                        <a href="#">
                                                            <i data-feather="edit"></i>
                                                        </a>
                                                    </li>
                                                    <li class="delete">
                                                        <a href="#" class="delete-btn">
                                                            <i data-feather="trash-2"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Quantum Solutions</td>
                                            <td>Starter</td>
                                            <td>Apr 12, 2025</td>
                                            <td>$299/mo</td>
                                            <td>
                                                <ul class="action">
                                                    <li class="edit">
                                                        <a href="#">
                                                            <i data-feather="edit"></i>
                                                        </a>
                                                    </li>
                                                    <li class="delete">
                                                        <a href="#" class="delete-btn">
                                                            <i data-feather="trash-2"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </td>
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
