@php
    $committees = \App\Models\Committee::all();
@endphp
@extends('layouts.app')

@section('title', 'Committees - MIS Alumni')

@section('content')
    <section class="page-header">
        <div class="container">
            <h1 class="page-title">Alumni Committees</h1>
            <p class="page-subtitle">
                Dedicated groups working to strengthen our alumni community and support our mission
            </p>
        </div>
    </section>

    <section class="content-section">
        <div class="container">
            <div class="committees-grid" id="committees-container">
                @foreach ($committees as $committee)
                    <div class="committee-card">
                        <div class="committee-logo text-center mb-3">
                            <img src="{{ $committee->logo && file_exists(storage_path('app/public/' . $committee->logo))
                                ? asset('storage/' . $committee->logo)
                                : asset('assets/images/no-image.jpg') }}"
                                alt="Committee Logo" style="width:100px; height:100px; object-fit:contain;">
                        </div>

                        {{-- Committee Name --}}
                        <h3 class="committee-title">{{ $committee->name }}</h3>

                        {{-- Committee Description --}}
                        <p class="committee-description">
                            {{ Str::limit(preg_replace('/\s+/', ' ', strip_tags(str_ireplace(['<br>', '<br/>', '<br />', '</p>', '<p>'], ["\n", "\n", "\n", "\n", "\n"], $committee->description))), 50, '...') }}

                        </p>

                        @php
                            $president = $committee->positions->firstWhere('position_name', 'President');
                        @endphp

                        <div class="info-item">
                            <div class="info-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    width="24" height="24">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                </svg>
                            </div>
                            <div class="info-content">
                                <div class="info-label">Leadership</div>
                                <div class="info-text">
                                    President: {{ $president ? $president->holder_name : 'N/A' }}
                                </div>
                            </div>
                        </div>


                        {{-- Committee Info --}}
                        <div class="committee-info mt-3">
                            <div class="info-item">
                                <div class="info-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2">
                                        </rect>
                                        <line x1="3" y1="10" x2="21" y2="10"></line>
                                    </svg>
                                </div>
                                <div class="info-content">
                                    <div class="info-label">Established On</div>
                                    <div class="info-text">
                                        {{ \Carbon\Carbon::parse($committee->established_date)->format('F j, Y') }}</div>
                                </div>
                            </div>
                        </div>

                        {{-- Button --}}
                        <button class="btn btn-primary" style="width: 100%; margin-top: 1rem;">View Details</button>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
