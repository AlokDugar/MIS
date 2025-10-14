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
                        <h3>My Profile</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active"> Profile</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="edit-profile">
                <div class="row">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h4 class="card-title mb-0">Change Password</h4>
                        </div>
                        <div class="card-body">
                            <form class="card" method="POST" action="{{ route('profile.update') }}"
                                onsubmit="return validateForm()">
                                @csrf
                                @method('PUT')
                                <div class="row mb-3">
                                    <div class="profile-title">
                                        <div class="d-lg-flex d-md-flex d-sm-flex align-items-center">
                                            <div class="p-image">
                                                <img class="img-100 rounded-circle profile-pic" alt=""
                                                    src="{{ asset('assets/images/user/no-image.jpg') }}">
                                            </div>
                                            <div class="flex-grow-1">
                                                <h3 class="mb-1 f-20 txt-primary">
                                                    <a href="user-profile.html"
                                                        class="upload-button">{{ Auth::user()->name }}</a>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label f-w-500">Old Password</label>
                                    <input class="form-control" id="old_password" name="old_password" type="password"
                                        required>
                                    <small id="old_password_error"></small>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label f-w-500">New Password</label>
                                    <input class="form-control @error('password') is-invalid @enderror" id="password"
                                        name="password" type="password" required>
                                    @error('password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label f-w-500">Confirm Password</label>
                                    <input class="form-control" id="password_confirmation" name="password_confirmation"
                                        type="password" required>
                                    @error('password_confirmation')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>


                                <div class="card-footer text-center">
                                    <button class="btn btn-primary" type="submit" id="submit_button">Update
                                        Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const oldPassword = document.getElementById("old_password");
            const oldPasswordError = document.getElementById("old_password_error");

            let timeout = null;

            oldPassword.addEventListener("input", function() {
                clearTimeout(timeout);

                let oldPasswordValue = oldPassword.value;

                if (oldPasswordValue.length > 0) {
                    timeout = setTimeout(() => {
                        checkOldPassword(oldPasswordValue);
                    }, 500);
                } else {
                    oldPasswordError.textContent = "";
                    oldPasswordError.style.color = "";
                }
            });

            function checkOldPassword(password) {
                fetch("{{ route('profile.checkOldPassword') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            old_password: password
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.valid) {
                            oldPasswordError.textContent = "✔ Old password is correct.";
                            oldPasswordError.style.color = "green";
                        } else {
                            oldPasswordError.textContent = "✘ Old password is incorrect.";
                            oldPasswordError.style.color = "red";
                        }
                    })
                    .catch(error => console.error("Error:", error));
            }
        });
    </script>
@endsection
