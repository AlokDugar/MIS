@php
    use App\Models\Event;
    use App\Models\EventTag;

    $events = Event::with('tags')->orderBy('date', 'desc')->get();
    $tags = EventTag::all();
@endphp

@extends('layouts.app')

@section('title', 'Events - MIS Alumni')

@section('content')
    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1 class="page-title">Alumni Events</h1>
            <p class="page-subtitle">
                Stay connected with the Modern Indian School community through our exciting events, reunions, and networking
                opportunities.
            </p>
        </div>
    </section>

    <!-- Filter Section -->
    <section class="filter-section">
        <div class="container">
            <div class="category-filter" id="eventFilters">
                <button class="filter-btn active" data-tag="all">All</button>
                @foreach ($tags as $tag)
                    <button class="filter-btn" data-tag="{{ $tag->id }}">{{ $tag->name }}</button>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Events Section -->
    <section class="content-section">
        <div class="container">
            <div class="events-grid" id="eventsGrid">
                @forelse($events as $event)
                    <div class="event-card" data-tags="{{ $event->tags->pluck('id')->implode(',') }}">
                        <div class="event-image">
                            <img src="{{ $event->image_path && file_exists(storage_path('app/public/' . $event->image_path))
                                ? asset('storage/' . $event->image_path)
                                : asset('assets/images/no-image.jpg') }}"
                                alt="{{ $event->name }}">

                            <div class="event-date-badge">
                                <div class="event-date-day">{{ $event->date->format('d') }}</div>
                                <div class="event-date-month">{{ $event->date->format('M') }}</div>
                            </div>
                        </div>

                        <div class="event-content">
                            <div class="event-header">
                                <h3 class="event-title">{{ $event->name }}</h3>
                                @if ($event->date)
                                    <p class="event-date-text">
                                        <svg class="icon-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        {{ $event->date->format('F j, Y') }}
                                    </p>
                                @endif
                            </div>

                            <p class="event-description">
                                {!! Str::limit(strip_tags($event->description, '<p><br>'), 50) !!}
                            </p>
                            @if ($event->tags->count() > 0)
                                <hr class="event-separator">
                            @endif
                            <div class="event-tags">
                                @foreach ($event->tags as $tag)
                                    <span class="event-tag">{{ $tag->name }}</span>
                                @endforeach
                            </div>

                            <button class="btn btn-primary" style="width: 100%; margin-top: 1rem;"
                                onclick="showEventDetails({{ $event->id }})">
                                View Details
                            </button>

                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <svg class="empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                        <h3>No Events Yet</h3>
                        <p>Check back soon for upcoming alumni events and reunions.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Event Details Modal -->
    <div class="modal" id="eventModal">
        <div class="modal-overlay" onclick="closeEventModal()"></div>
        <div class="modal-content">
            <button class="modal-close" onclick="closeEventModal()">
                <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            <div id="eventModalContent">
                Content will be loaded dynamically
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filterButtons = document.querySelectorAll('.filter-btn');
            const eventCards = document.querySelectorAll('.event-card');

            filterButtons.forEach(button => {
                button.addEventListener('click', function() {
                    filterButtons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');

                    const selectedTag = this.getAttribute('data-tag');

                    eventCards.forEach(card => {
                        const cardTags = card.getAttribute('data-tags').split(',');
                        card.style.display = (selectedTag === 'all' || cardTags.includes(
                            selectedTag)) ? 'flex' : 'none';
                    });
                });
            });
        });

        // Modal
        function showEventDetails(eventId) {
            const modal = document.getElementById('eventModal');
            const modalContent = document.getElementById('eventModalContent');

            modalContent.innerHTML = '<div class="loading">Loading event details...</div>';
            modal.classList.add('active');

            fetch(`/api/v1/events/${eventId}`)
                .then(response => response.json())
                .then(event => {
                    modalContent.innerHTML = `
                        <img src="${event.image_path && event.image_path !== '' ? '/storage/' + event.image_path : '/assets/images/no-image.jpg'}"
                            alt="${event.name}"
                            class="modal-image">
                        <h2 class="modal-title">${event.name}</h2>
                        ${event.date ? `<p class="modal-date">${new Date(event.date).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' })}</p>` : ''}
                        <div class="modal-description">${event.description}</div>
                        ${event.tags && event.tags.length > 0 ? `<div class="event-tags">${event.tags.map(tag => `<span class="event-tag">${tag.name}</span>`).join('')}</div>` : ''}
                    `;
                })
                .catch(error => {
                    modalContent.innerHTML = '<div class="error-state">Failed to load event details.</div>';
                });
        }

        function closeEventModal() {
            document.getElementById('eventModal').classList.remove('active');
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeEventModal();
        });
    </script>
@endpush
