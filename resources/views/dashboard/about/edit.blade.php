@extends('layouts.dashboard')
@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h4>Edit About Us</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('about.update', $about->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label>Our Story</label>
                            <textarea name="our_story" class="form-control ckeditor">{{ old('our_story', $about->our_story) }}</textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label>Mission</label>
                            <textarea name="mission" class="form-control ckeditor">{{ old('mission', $about->mission) }}</textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label>Vision</label>
                            <textarea name="vision" class="form-control ckeditor">{{ old('vision', $about->vision) }}</textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label>Values</label>
                            <textarea name="values" class="form-control ckeditor">{{ old('values', $about->values) }}</textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label>Impact</label>
                            <textarea name="impact" class="form-control ckeditor">{{ old('impact', $about->impact) }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-success">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
