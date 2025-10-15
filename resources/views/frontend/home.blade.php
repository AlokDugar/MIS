@extends('layouts.app')

@section('title', 'MIS Alumni - Home')

@section('content')
    <section class="hero-section">
        <div class="hero-background"></div>
        <div class="hero-content">
            <div class="hero-badge">
                <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M22 10v6M2 10l10-5 10 5-10 5z"></path>
                    <path d="M6 12v5c3 3 9 3 12 0v-5"></path>
                </svg>
                <span>Connecting Modern Indian School Alumni Worldwide</span>
            </div>

            <h1 class="hero-title">
                Welcome to <span class="text-primary">MIS Alumni</span>
            </h1>

            <p class="hero-description">
                A vibrant community connecting Modern Indian School graduates across the globe. Reconnect with classmates,
                share memories, and build lasting professional and personal relationships.
            </p>

            <div class="hero-buttons">
                <button class="btn btn-primary">
                    Join the Network
                    <svg class="icon-sm" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M5 12h14M12 5l7 7-7 7"></path>
                    </svg>
                </button>
                <a href="{{ url('/fevents') }}">
                    <button class="btn btn-outline">Explore Events</button>
                </a>
            </div>

            <div class="hero-stats">
                <div class="stat-card">
                    <svg class="stat-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                    <div class="stat-number">3,500+</div>
                    <div class="stat-label">Alumni Members</div>
                </div>
                <div class="stat-card">
                    <svg class="stat-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                        <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                    </svg>
                    <div class="stat-number">25+</div>
                    <div class="stat-label">Countries Represented</div>
                </div>
                <div class="stat-card">
                    <svg class="stat-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M22 10v6M2 10l10-5 10 5-10 5z"></path>
                        <path d="M6 12v5c3 3 9 3 12 0v-5"></path>
                    </svg>
                    <div class="stat-number">40+</div>
                    <div class="stat-label">Years of Legacy</div>
                </div>
            </div>
        </div>
    </section>

    <section class="about-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">About MIS Alumni</h2>
                <p class="section-description">
                    Building bridges between generations of Modern Indian School graduates
                </p>
            </div>

            <div class="about-grid">
                <div class="about-card">
                    <div class="about-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 2L2 7l10 5 10-5-10-5z"></path>
                            <path d="M2 17l10 5 10-5M2 12l10 5 10-5"></path>
                        </svg>
                    </div>
                    <h3 class="about-card-title">Our Mission</h3>
                    <p class="about-card-text">
                        To foster a lifelong connection among Modern Indian School alumni, celebrating our shared heritage
                        and supporting each other's personal and professional growth across generations and borders.
                    </p>
                </div>

                <div class="about-card">
                    <div class="about-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                    </div>
                    <h3 class="about-card-title">Our Community</h3>
                    <p class="about-card-text">
                        A diverse network of accomplished individuals spanning multiple continents, industries, and
                        generations, all united by the values and experiences we gained at Modern Indian School.
                    </p>
                </div>

                <div class="about-card">
                    <div class="about-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                        </svg>
                    </div>
                    <h3 class="about-card-title">Our Values</h3>
                    <p class="about-card-text">
                        Excellence, integrity, and service - the core principles instilled in us at MIS continue to guide
                        our alumni network as we support, mentor, and inspire one another.
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
