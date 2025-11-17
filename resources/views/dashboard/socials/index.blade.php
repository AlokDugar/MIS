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

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center justify-content-between"
                        role="alert">
                        <span>{{ session('error') }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="row">
                    <div class="col-sm-6">
                        <h3>Social Media Links</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">MIS - Admin Panel</a></li>
                            <li class="breadcrumb-item active">Socials</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">

                        <div class="card">
                            <div class="card-body">

                                <form action="{{ route('socials.update') }}" method="POST">
                                    @csrf

                                    <div class="form-group">
                                        <label>Facebook</label>
                                        <input type="url" name="facebook"
                                            class="form-control @error('facebook') is-invalid @enderror"
                                            value="{{ old('facebook', $social->facebook ?? '') }}">
                                        @error('facebook')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group mt-3">
                                        <label>Instagram</label>
                                        <input type="url" name="instagram"
                                            class="form-control @error('instagram') is-invalid @enderror"
                                            value="{{ old('instagram', $social->instagram ?? '') }}">
                                        @error('instagram')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group mt-3">
                                        <label>LinkedIn</label>
                                        <input type="url" name="linkedin"
                                            class="form-control @error('linkedin') is-invalid @enderror"
                                            value="{{ old('linkedin', $social->linkedin ?? '') }}">
                                        @error('linkedin')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group mt-3">
                                        <label>X (formerly Twitter)</label>
                                        <input type="url" name="X"
                                            class="form-control @error('X') is-invalid @enderror"
                                            value="{{ old('X', $social->X ?? '') }}">
                                        @error('X')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group mt-3">
                                        <label>YouTube</label>
                                        <input type="url" name="youtube"
                                            class="form-control @error('youtube') is-invalid @enderror"
                                            value="{{ old('youtube', $social->youtube ?? '') }}">
                                        @error('youtube')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="text-center mt-4">
                                        <button type="submit" class="btn btn-primary">
                                            Save Socials
                                        </button>
                                    </div>

                                </form>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
