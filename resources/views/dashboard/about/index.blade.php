@extends('layouts.dashboard')
@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>About Us</h4>
                    @if (!$about)
                        <a href="{{ route('about.create') }}" class="btn btn-primary">Add</a>
                    @endif
                </div>
                <div class="card-body">
                    @if ($about)
                        <p><strong>Our Story:</strong> {!! $about->our_story !!}</p>
                        <p><strong>Mission:</strong> {!! $about->mission !!}</p>
                        <p><strong>Vision:</strong> {!! $about->vision !!}</p>
                        <p><strong>Values:</strong> {!! $about->values !!}</p>
                        <p><strong>Impact:</strong> {!! $about->impact !!}</p>
                        <a href="{{ route('about.edit', $about->id) }}" class="btn btn-warning">Edit</a>
                    @else
                        <p>No about information added yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
