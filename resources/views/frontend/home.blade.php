@extends('layouts.app')
@section('title', 'MIS Alumni - Home')
@section('content')
    <div class="min-h-screen">

        {{-- Hero Section --}}
        <section class="relative h-screen flex items-center justify-center overflow-hidden">
            <div class="absolute inset-0 z-0"
                style="background-image: url('{{ asset('assets/hero-alumni.jpg') }}');
                    background-size: cover;
                    background-position: center;
                    filter: brightness(0.7);">
            </div>
            <div class="absolute inset-0 bg-gradient-to-b from-primary/30 via-primary/20 to-background/40 z-0"></div>

            <div class="container mx-auto px-4 z-10 text-center transition-all duration-1000 opacity-100 translate-y-0">
                <h1 class="text-5xl md:text-7xl font-bold text-white mb-6 drop-shadow-lg">
                    Welcome to the<br>
                    <span class="text-white drop-shadow-2xl">MIS Alumni Network</span>
                </h1>
                <p class="text-xl md:text-2xl text-white/90 mb-8 max-w-3xl mx-auto">
                    Connecting Modern Indian School graduates worldwide, fostering lifelong relationships and professional
                    growth
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <a href="#"
                        class="bg-primary hover:bg-primary/90 shadow-elevated hover:scale-105 transition-all duration-300 text-lg px-8 py-6 text-white font-semibold inline-flex items-center">
                        Join the Network
                        <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                    <a href="#"
                        class="border-2 border-white bg-white/10 backdrop-blur-md text-white hover:bg-white/20 text-lg px-8 py-6 shadow-lg font-semibold inline-block">
                        Explore More
                    </a>
                </div>
            </div>

            {{-- Scroll Indicator --}}
            <div class="absolute bottom-10 left-1/2 -translate-x-1/2 z-10 animate-bounce">
                <div class="w-6 h-10 border-2 border-white/50 rounded-full flex justify-center">
                    <div class="w-1 h-3 bg-white/50 rounded-full mt-2 animate-pulse"></div>
                </div>
            </div>
        </section>

        {{-- Carousel Section --}}
        @php
            $carouselImages = [
                ['image' => 'event-networking.jpg', 'title' => 'Alumni Networking Event'],
                ['image' => 'reunion-dinner.jpg', 'title' => 'Class Reunion Dinner'],
                ['image' => 'campus-1.jpg', 'title' => 'Campus Visit'],
                ['image' => 'mentorship-1.jpg', 'title' => 'Mentorship Program'],
                ['image' => 'collaboration-1.jpg', 'title' => 'Innovation Workshop'],
                ['image' => 'sports-event-1.jpg', 'title' => 'Annual Sports Day'],
                ['image' => 'awards-ceremony.jpg', 'title' => 'Awards Ceremony'],
                ['image' => 'virtual-meeting.jpg', 'title' => 'Virtual Meetup'],
                ['image' => 'workshop-1.jpg', 'title' => 'Leadership Workshop'],
                ['image' => 'graduation-celebration.jpg', 'title' => 'Graduation Celebration'],
                ['image' => 'library-study.jpg', 'title' => 'Study Reunion'],
                ['image' => 'career-fair.jpg', 'title' => 'Career Fair'],
            ];
        @endphp
        <section class="py-16 bg-gradient-to-b from-secondary/30 to-background">
            <div class="container mx-auto px-4 text-center mb-12">
                <h2 class="text-4xl md:text-5xl font-bold text-foreground mb-4">Moments That Matter</h2>
                <p class="text-xl text-muted-foreground max-w-2xl mx-auto">
                    Explore highlights from our vibrant alumni community events and celebrations
                </p>
            </div>
            <div class="flex gap-6 overflow-x-auto snap-x snap-mandatory pb-8 carousel">
                @foreach ($carouselImages as $item)
                    <div class="flex-none w-[400px] snap-center">
                        <div
                            class="overflow-hidden glass-effect hover:shadow-elevated transition-all duration-300 hover:scale-[1.03] cursor-pointer h-full">
                            <div class="relative h-[500px] overflow-hidden">
                                <img src="{{ asset('assets/' . $item['image']) }}" alt="{{ $item['title'] }}"
                                    class="w-full h-full object-cover transition-transform duration-500 hover:scale-110" />
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-background via-background/50 to-transparent">
                                    <div class="absolute bottom-0 left-0 right-0 p-6">
                                        <h3 class="text-white font-bold text-2xl drop-shadow-lg">{{ $item['title'] }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        {{-- CTA Section --}}
        <section class="py-16 bg-gradient-to-br from-primary via-primary/90 to-primary-foreground relative overflow-hidden">
            <div class="container mx-auto px-4 relative z-10 text-center max-w-3xl mx-auto">
                <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">Ready to Reconnect?</h2>
                <p class="text-xl text-white/95 mb-8">
                    Join thousands of MIS alumni and unlock exclusive opportunities for networking, mentorship, and career
                    growth.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="#"
                        class="bg-white text-primary hover:bg-white/90 shadow-elevated hover:scale-105 transition-all duration-300 text-lg px-8 py-6 font-semibold inline-flex items-center">
                        Get Started Today
                        <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                    <a href="{{ route('about') }}"
                        class="border-2 border-white bg-white/10 backdrop-blur-md text-white hover:bg-white/20 text-lg px-8 py-6 font-semibold inline-block">
                        Learn More
                    </a>
                </div>
            </div>
        </section>

    </div>
@endsection
