@extends('layouts.dashboard')
@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h4>Add About Us</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('about.store') }}" method="POST">
                        @csrf

                        <div class="form-group mb-3">
                            <label>Our Story</label>
                            <textarea name="our_story" class="form-control ckeditor">{{ old('our_story') }}</textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label>Mission</label>
                            <textarea name="mission" class="form-control ckeditor">{{ old('mission') }}</textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label>Vision</label>
                            <textarea name="vision" class="form-control ckeditor">{{ old('vision') }}</textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label>Values</label>
                            <textarea name="values" class="form-control ckeditor">{{ old('values') }}</textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label>Impact</label>
                            <textarea name="impact" class="form-control ckeditor">{{ old('impact') }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-success">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
