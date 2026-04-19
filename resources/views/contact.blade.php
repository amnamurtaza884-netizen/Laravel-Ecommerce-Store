@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <h2 class="mb-4 text-center">Contact Us</h2>

            <!-- SUCCESS MESSAGE -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- ERROR MESSAGE -->
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle"></i>
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="row">

                <!-- CONTACT INFO -->
                <div class="col-md-5 mb-4">

                    <div class="card shadow h-100">

                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="bi bi-info-circle"></i> Get In Touch</h5>
                        </div>

                        <div class="card-body">

                            <div class="mb-3">
                                <i class="bi bi-geo-alt text-primary me-2"></i>
                                <strong>Address:</strong><br>
                                <span class="text-muted">123 Shopping Street, Commerce City, CC 12345</span>
                            </div>

                            <div class="mb-3">
                                <i class="bi bi-telephone text-success me-2"></i>
                                <strong>Phone:</strong><br>
                                <span class="text-muted">+1 (555) 123-4567</span>
                            </div>

                            <div class="mb-3">
                                <i class="bi bi-envelope text-warning me-2"></i>
                                <strong>Email:</strong><br>
                                <span class="text-muted">support@ecommerce.com</span>
                            </div>

                            <div class="mb-3">
                                <i class="bi bi-clock text-info me-2"></i>
                                <strong>Business Hours:</strong><br>
                                <span class="text-muted">Mon-Fri: 9AM-6PM<br>Sat-Sun: 10AM-4PM</span>
                            </div>

                        </div>

                    </div>

                </div>

                <!-- CONTACT FORM -->
                <div class="col-md-7">

                    <div class="card shadow">

                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0"><i class="bi bi-envelope-paper"></i> Send us a Message</h5>
                        </div>

                        <div class="card-body">

                            <form method="POST" action="{{ route('contact.store') }}">
                                @csrf

                                <!-- NAME (Auto-filled for logged in users) -->
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Your Name</label>
                                    <input type="text" name="name" class="form-control"
                                           value="{{ auth()->check() ? auth()->user()->name : '' }}"
                                           placeholder="Enter your full name" required>
                                </div>

                                <!-- EMAIL (Auto-filled for logged in users) -->
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Email Address</label>
                                    <input type="email" name="email" class="form-control"
                                           value="{{ auth()->check() ? auth()->user()->email : '' }}"
                                           placeholder="Enter your email address" required>
                                </div>

                                <!-- SUBJECT -->
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Subject</label>
                                    <select name="subject" class="form-select" required>
                                        <option value="">Select a subject</option>
                                        <option value="order">Order Inquiry</option>
                                        <option value="product">Product Information</option>
                                        <option value="support">Technical Support</option>
                                        <option value="complaint">Complaint</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>

                                <!-- MESSAGE -->
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Your Message</label>
                                    <textarea name="message" class="form-control" rows="5"
                                              placeholder="Please describe your inquiry in detail..." required></textarea>
                                    <div class="form-text">We'll get back to you within 24 hours.</div>
                                </div>

                                <!-- SUBMIT BUTTON -->
                                <button type="submit" class="btn btn-primary w-100 btn-lg">
                                    <i class="bi bi-send"></i> Send Message
                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection