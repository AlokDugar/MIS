@extends('layouts.dashboard')

@section('content')

<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center justify-content-between" role="alert">
                    <span>{{ session('error') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show d-flex align-items-center justify-content-between" role="alert">
                    <span>{{ session('success') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row">
                <div class="col-sm-6">
                    <h3>Settings</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">ERP Dashboard</a></li>
                        <li class="breadcrumb-item active">Settings</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">

                            <form action="{{route('settings.update')}}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label>Website Name</label>
                                    <input type="text" name="website_name" class="form-control @error('website_name') is-invalid @enderror" value="{{ old('website_name', $settings->website_name ?? '') }}" required>
                                    @error('website_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Site Logo</label>
                                    @if($settings && $settings->site_logo)
                                        <img src="{{ asset('storage/' . $settings->site_logo) }}" height="80" class="mt-2">
                                    @endif
                                    <input type="file" name="site_logo" class="form-control mt-3 @error('site_logo') is-invalid @enderror">
                                    @error('site_logo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Dashboard Logo</label>
                                    @if($settings && $settings->dashboard_logo)
                                        <img src="{{ asset('storage/' . $settings->dashboard_logo) }}" height="80" class="mt-2">
                                    @endif
                                    <input type="file" name="dashboard_logo" class="form-control mt-3 @error('dashboard_logo') is-invalid @enderror">
                                    @error('dashboard_logo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Favicon</label>
                                    @if($settings && $settings->favicon)
                                        <img src="{{ asset('storage/' . $settings->favicon) }}" height="40" class="mt-2">
                                    @endif
                                    <input type="file" name="favicon" class="form-control mt-3 @error('favicon') is-invalid @enderror">
                                    @error('favicon')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary mt-3">Save Settings</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
