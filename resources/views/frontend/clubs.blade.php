@php
    use App\Models\Club;
    use App\Models\ClubTag;

    $clubs = Club::with('tags')->get();
    $tags = ClubTag::all();
@endphp

@extends('layouts.app')

@section('title', 'Clubs - MIS Alumni')
@push('styles')
    <style>
        .club-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            /* same as event tags */
            margin-bottom: 1rem;
        }

        .club-tags .badge-custom-blue {
            background-color: #1e90ff;
            /* Dodger Blue shade */
            color: #fff;
            /* White text */
            font-size: 0.75rem;
            /* Slightly smaller text */
            padding: 0.25rem 0.75rem;
            /* Match event tags padding */
            border-radius: 9999px;
            /* Fully rounded like event tags */
            margin-left: 0.5rem;
            /* Match spacing between event tags */
            display: inline-block;
            /* Ensure proper inline spacing */
            font-weight: 500;
            /* Same weight as event tags */
        }
    </style>
@endpush
@section('content')
    {{-- Page Header --}}
    <section class="page-header">
        <div class="container">
            <h1 class="page-title">Alumni Clubs</h1>
            <p class="page-subtitle">
                Connect with fellow alumni who share your interests and passions
            </p>
        </div>
    </section>

    {{-- Filter Section --}}
    <section class="filter-section mb-4">
        <div class="container">
            <div class="category-filter">
                <button class="filter-btn active" data-category="all">All</button>
                @foreach ($tags as $tag)
                    <button class="filter-btn" data-category="tag-{{ $tag->id }}">{{ $tag->name }}</button>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Clubs Section --}}
    <section class="content-section">
        <div class="container">
            <div class="clubs-grid" id="clubs-container">
                @foreach ($clubs as $club)
                    @php
                        $categoryClasses = $club->tags->map(fn($tag) => 'tag-' . $tag->id)->implode(' ');
                    @endphp

                    <div class="club-card {{ $categoryClasses }}" style="position: relative;">
                        {{-- Tags on Top Right --}}
                        <div class="club-tags" style="position: absolute; top: 10px; right: 10px;">
                            @foreach ($club->tags as $tag)
                                <span class="badge-custom-blue">{{ $tag->name }}</span>
                            @endforeach
                        </div>

                        {{-- Club Logo --}}
                        <div class="club-logo text-center mb-3">
                            <img src="{{ $club->logo && file_exists(storage_path('app/public/' . $club->logo))
                                ? asset('storage/' . $club->logo)
                                : asset('assets/images/no-image.jpg') }}"
                                alt="Club Logo" style="width:100px; height:100px; object-fit:contain;">
                        </div>

                        {{-- Club Name --}}
                        <h3 class="club-title">{{ $club->name }}</h3>

                        {{-- Club Info --}}
                        <div class="club-info mt-3">
                            {{-- Leadership --}}
                            <div class="info-item d-flex align-items-center mb-2">
                                <div class="info-icon me-2">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        width="24" height="24">
                                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="9" cy="7" r="4"></circle>
                                    </svg>
                                </div>

                                <div class="info-content">
                                    <div class="info-label">Leadership</div>
                                    <div class="info-text"> President: {{ $club->president }} </div>
                                </div>
                            </div>

                            {{-- Members --}}
                            <div class="info-item d-flex align-items-center mb-2">
                                <div class="info-icon me-2">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        width="24" height="24">
                                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="9" cy="7" r="4"></circle>
                                        <path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"></path>
                                    </svg>
                                </div>
                                <div class="info-content">
                                    <div class="info-label">Members</div>
                                    <div class="info-text">{{ $club->members }} members</div>
                                </div>
                            </div>

                            {{-- Established Date --}}
                            <div class="info-item d-flex align-items-center mb-2">
                                <div class="info-icon me-2">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        width="24" height="24">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2">
                                        </rect>
                                        <line x1="3" y1="10" x2="21" y2="10"></line>
                                    </svg>
                                </div>
                                <div class="info-content">
                                    <div class="info-label">Established On</div>
                                    <div class="info-text">
                                        {{ \Carbon\Carbon::parse($club->established_date)->format('F j, Y') }}</div>
                                </div>
                            </div>
                        </div>

                        {{-- Join Button --}}
                        <button class="btn btn-primary mt-3" style="width: 100%;">Join Club</button>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        // Club filtering by tag
        document.querySelectorAll('.filter-btn').forEach(button => {
            button.addEventListener('click', function() {
                const category = this.dataset.category;

                // Update active state
                document.querySelectorAll('.filter-btn').forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');

                // Filter clubs
                document.querySelectorAll('.club-card').forEach(card => {
                    if (category === 'all') {
                        card.style.display = 'flex';
                    } else if (card.classList.contains(category)) {
                        card.style.display = 'flex';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    </script>
@endpush
