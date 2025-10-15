@php
    use App\Models\ContactInfo;
    $info = ContactInfo::first();
@endphp

@extends('layouts.app')

@section('title', 'Contact - MIS Alumni')

@section('content')
    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1 class="page-title">Contact Us</h1>
            <p class="page-subtitle">
                Get in touch with the MIS Alumni Association
            </p>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="content-section">
        <div class="container">
            <div class="contact-grid">

                <!-- Contact Info -->
                <div class="contact-info">
                    <h2>Let's Connect</h2>
                    <p>
                        Whether you have questions, suggestions, or just want to reconnect with the MIS Alumni community,
                        we'd love to hear from you. Reach out through any of the channels below.
                    </p>

                    <div class="contact-methods">
                        <div class="contact-method">
                            <div class="contact-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                    </path>
                                    <polyline points="22,6 12,13 2,6"></polyline>
                                </svg>
                            </div>
                            <div>
                                <h3>Email</h3>
                                <a href="https://mail.google.com/mail/?view=cm&fs=1&to={{ $info->email }}" target="blank">
                                    {{ $info->email }}
                                </a>
                            </div>

                        </div>

                        <div class="contact-method">
                            <div class="contact-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path
                                        d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h3>Phone</h3>
                                <a href="tel:{{ $info->phone }}" target="_blank">+977-{{ $info->phone }}</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="contact-form-wrapper">
                    <form id="contactForm">
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name" required>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" required>
                            </div>

                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" id="phone" name="phone">
                            </div>

                            <div class="form-group">
                                <label for="subject">Subject</label>
                                <input type="text" id="subject" name="subject" required>
                            </div>

                            <div class="form-group full-width">
                                <label for="message">Message</label>
                                <textarea id="message" name="message" required></textarea>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary" style="width: 100%;">
                            Send Message
                        </button>

                        <div id="formMessage" class="mt-3"></div>
                    </form>

                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const form = e.target;
            const formData = {
                name: form.name.value,
                email: form.email.value,
                phone: form.phone.value,
                subject: form.subject.value,
                message: form.message.value
            };

            axios.post('/api/v1/contact-lists', formData)
                .then(response => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Your message has been sent successfully.',
                        confirmButtonText: 'OK'
                    });
                    form.reset();
                })
                .catch(error => {
                    let errorMsg = 'Something went wrong.';
                    if (error.response && error.response.data && error.response.data.message) {
                        errorMsg = error.response.data.message;
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: errorMsg,
                        confirmButtonText: 'OK'
                    });
                });
        });
    </script>
@endpush
