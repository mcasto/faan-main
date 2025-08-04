@extends('layouts.app')

@section('title', $meta['title'] ?? 'Adoptions - FAAN Foundation')
@section('description',
    $meta['description'] ??
    'Adopt a rescued animal in Ecuador. Find your perfect companion through
    FAAN Foundation animal adoption program')

@section('content')
    <div class="min-h-screen w-full max-w-full overflow-hidden">
        {{-- Main Content --}}
        <div class="py-12 w-full">
            <div class="px-4 w-full max-w-full">
                <div class="max-w-6xl mx-auto w-full">

                    {{-- Page Title --}}
                    <div class="text-center mb-12">
                        <h1 class="text-4xl font-bold text-gray-900 mb-4">
                            {{ app()->getLocale() === 'es' ? 'Adopciones' : 'Adoptions' }}
                        </h1>
                        <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                            {{ app()->getLocale() === 'es'
                                ? 'Dale una segunda oportunidad a un animal rescatado. Encuentra tu compañero perfecto y cambia una vida para siempre.'
                                : 'Give a rescued animal a second chance. Find your perfect companion and change a life forever.' }}
                        </p>
                    </div>

                    {{-- Adoptee Header --}}
                    @if (isset($sections['adoptee-header']))
                        <section class="mb-16">
                            <div class="bg-white rounded-lg shadow-lg p-8">
                                <div class="prose prose-lg max-w-none">
                                    {!! $sections['adoptee-header']['html'] !!}
                                </div>
                            </div>
                        </section>
                    @endif

                    {{-- Main Page Content --}}
                    @if (isset($sections['page']))
                        <section class="mb-16">
                            <div class="bg-gray-50 rounded-lg p-8">
                                <div class="prose prose-lg max-w-none">
                                    {!! $sections['page']['html'] !!}
                                </div>
                            </div>
                        </section>
                    @endif

                    {{-- Available Adoptees Carousel --}}
                    @if (isset($sections['adoptees']))
                        <section class="mb-16">
                            <h2 class="text-3xl font-bold text-center mb-12 text-gray-900">
                                {{ app()->getLocale() === 'es' ? 'Animales Disponibles para Adopción' : 'Animals Available for Adoption' }}
                            </h2>

                            @if (is_array($sections['adoptees']))
                                <div x-data="adopteeCarousel({{ json_encode(array_values($sections['adoptees'])) }})" class="relative w-full max-w-full mx-auto overflow-hidden"
                                    style="max-width: 100vw; overflow: hidden;" @mouseenter="pauseOnHover()"
                                    @mouseleave="resumeOnLeave()">

                                    <!-- Navigation Controls - Moved to Top -->
                                    <div class="flex items-center justify-center space-x-4 mb-6">
                                        <!-- Previous Button -->
                                        <button @click="previousSlide()"
                                            class="bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-full shadow-lg transition-colors duration-200 cursor-pointer">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 19l-7-7 7-7"></path>
                                            </svg>
                                        </button>

                                        <!-- Slide Indicators -->
                                        <div class="flex space-x-2">
                                            <template x-for="(adoptee, index) in adoptees" :key="index">
                                                <button @click="currentSlide = index"
                                                    class="w-3 h-3 rounded-full transition-colors duration-200 cursor-pointer"
                                                    :class="currentSlide === index ? 'bg-blue-600' : 'bg-gray-300'">
                                                </button>
                                            </template>
                                        </div>

                                        <!-- Next Button -->
                                        <button @click="nextSlide()"
                                            class="bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-full shadow-lg transition-colors duration-200 cursor-pointer">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </button>
                                    </div>

                                    <!-- Slide Counter -->
                                    <div class="text-center mb-4 text-gray-600">
                                        <span x-text="currentSlide + 1"></span> of <span x-text="adoptees.length"></span>
                                    </div>

                                    <!-- Carousel Container -->
                                    <div class="relative overflow-hidden rounded-lg shadow-lg"
                                        style="max-width: 100%; overflow: hidden;" @touchstart="handleTouchStart($event)"
                                        @touchend="handleTouchEnd($event)">
                                        <div class="flex transition-transform duration-500 ease-in-out"
                                            style="max-width: 100%;"
                                            x-bind:style="`transform: translateX(-${currentSlide * 100}%); max-width: 100%;`">

                                            <template x-for="(adoptee, index) in adoptees" :key="index">
                                                <div class="w-full flex-shrink-0"
                                                    style="max-width: 100%; overflow: hidden;">
                                                    <div class="bg-gray-100 p-8 min-h-[500px] flex items-center justify-center"
                                                        style="max-width: 100%; overflow: hidden;">
                                                        <div class="w-full max-w-4xl mx-auto text-center px-4"
                                                            style="max-width: 100%; overflow: hidden;">
                                                            <div class="prose prose-lg w-full max-w-full mx-auto overflow-hidden"
                                                                style="max-width: 100% !important; overflow: hidden !important;"
                                                                x-html="adoptee.html">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </template>
                                        </div>
                                    </div>

                                    <!-- Auto-play Controls and Instructions -->
                                    <div class="flex flex-col items-center mt-6 space-y-2">
                                        <button @click="toggleAutoplay()"
                                            class="text-sm text-blue-600 hover:text-blue-700 font-medium transition-colors">
                                            <span x-show="!autoplay">▶ Auto Play</span>
                                            <span x-show="autoplay">⏸ Pause</span>
                                        </button>

                                        <div class="text-center text-xs text-gray-500">
                                            {{ app()->getLocale() === 'es'
                                                ? 'Usa las flechas del teclado ← → o desliza para navegar. Espacio para pausar.'
                                                : 'Use keyboard arrows ← → or swipe to navigate. Space to pause.' }}
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </section>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection

@push('head')
    <style>
        /* Global box-sizing and overflow fixes */
        * {
            box-sizing: border-box !important;
        }

        body,
        html {
            overflow-x: hidden !important;
        }

        .prose img {
            margin: 0 auto;
            border-radius: 8px;
            max-width: 100%;
            height: auto;
        }

        .prose {
            max-width: 100% !important;
            overflow-wrap: break-word;
            word-wrap: break-word;
            overflow: hidden !important;
        }

        .prose * {
            max-width: 100% !important;
            box-sizing: border-box !important;
        }

        /* Carousel container constraints */
        [x-data] {
            max-width: 100% !important;
            overflow: hidden !important;
        }

        /* Fix floated adoptee images - Replace float with flex */
        .adoptee {
            overflow: hidden !important;
            min-height: 220px;
            padding: 1rem;
            max-width: 100% !important;
            word-wrap: break-word;
            display: flex !important;
            flex-direction: row !important;
            gap: 1rem;
        }

        .adoptee img {
            float: none !important;
            height: 200px !important;
            width: auto !important;
            max-width: 200px !important;
            min-width: 150px !important;
            flex-shrink: 0 !important;
            border-radius: 8px;
            object-fit: cover;
        }

        .adoptee-image-section {
            display: flex !important;
            flex-direction: column !important;
            align-items: center !important;
            flex-shrink: 0 !important;
            gap: 0.5rem !important;
        }

        .adoptee-content {
            flex: 1 !important;
            overflow: hidden !important;
        }

        .adoptee .name {
            font-size: 1.25rem !important;
            font-weight: bold !important;
            margin: 0.5rem 0 0 0 !important;
            max-width: 100% !important;
            text-align: center !important;
            color: #1f2937 !important;
        }

        .adoptee .description {
            text-align: justify;
            line-height: 1.6;
            overflow-wrap: break-word;
            word-wrap: break-word;
            max-width: 100% !important;
            margin-top: 0 !important;
        }

        /* Carousel slide constraints */
        .flex>div {
            max-width: 100% !important;
            overflow: hidden !important;
        }

        .adoptee-card {
            transition: transform 0.3s ease;
        }

        .adoptee-card:hover {
            transform: translateY(-5px);
        }

        /* Carousel specific styles */
        .carousel-slide {
            scroll-snap-align: start;
        }

        /* Prevent content overflow */
        .carousel-content {
            max-width: 100%;
            overflow: hidden;
        }

        /* Responsive adjustments for adoptee cards */
        @media (max-width: 768px) {
            .adoptee {
                flex-direction: column !important;
                text-align: center;
                align-items: center !important;
            }

            .adoptee-image-section {
                align-items: center !important;
            }

            .adoptee img {
                align-self: center !important;
                max-width: 70% !important;
                height: 180px !important;
            }

            .adoptee .name {
                font-size: 1.25rem !important;
                text-align: center !important;
                margin: 0.5rem 0 1rem 0 !important;
            }

            .adoptee .description {
                text-align: left;
            }
        }
    </style>
    <script>
        function adopteeCarousel(adoptees) {
            return {
                adoptees: adoptees,
                currentSlide: 0,
                autoplay: true,
                autoplayInterval: null,
                touchStartX: 0,
                touchEndX: 0,

                init() {
                    this.startAutoplay();
                    this.setupKeyboardNavigation();
                    this.fixContentLayout();
                },

                nextSlide() {
                    this.currentSlide = (this.currentSlide + 1) % this.adoptees.length;
                    this.fixContentLayout();
                },

                previousSlide() {
                    this.currentSlide = this.currentSlide === 0 ?
                        this.adoptees.length - 1 : this.currentSlide - 1;
                    this.fixContentLayout();
                },

                goToSlide(index) {
                    this.currentSlide = index;
                    this.fixContentLayout();
                },

                startAutoplay() {
                    if (this.autoplay && this.adoptees.length > 1) {
                        this.autoplayInterval = setInterval(() => {
                            this.nextSlide();
                        }, 5000); // 5 seconds
                    }
                },

                stopAutoplay() {
                    if (this.autoplayInterval) {
                        clearInterval(this.autoplayInterval);
                        this.autoplayInterval = null;
                    }
                },

                toggleAutoplay() {
                    this.autoplay = !this.autoplay;
                    if (this.autoplay) {
                        this.startAutoplay();
                    } else {
                        this.stopAutoplay();
                    }
                },

                // Pause autoplay on hover
                pauseOnHover() {
                    if (this.autoplay) {
                        this.stopAutoplay();
                    }
                },

                // Resume autoplay when not hovering
                resumeOnLeave() {
                    if (this.autoplay) {
                        this.startAutoplay();
                    }
                },

                // Touch support
                handleTouchStart(e) {
                    this.touchStartX = e.touches[0].clientX;
                },

                handleTouchEnd(e) {
                    this.touchEndX = e.changedTouches[0].clientX;
                    this.handleSwipe();
                },

                handleSwipe() {
                    const swipeThreshold = 50;
                    const diff = this.touchStartX - this.touchEndX;

                    if (Math.abs(diff) > swipeThreshold) {
                        if (diff > 0) {
                            // Swipe left - next slide
                            this.nextSlide();
                        } else {
                            // Swipe right - previous slide
                            this.previousSlide();
                        }
                    }
                },

                // Keyboard navigation
                setupKeyboardNavigation() {
                    document.addEventListener('keydown', (e) => {
                        if (e.key === 'ArrowLeft') {
                            this.previousSlide();
                        } else if (e.key === 'ArrowRight') {
                            this.nextSlide();
                        } else if (e.key === ' ') {
                            e.preventDefault();
                            this.toggleAutoplay();
                        }
                    });
                },

                // Fix content layout after rendering
                fixContentLayout() {
                    setTimeout(() => {
                        document.querySelectorAll('.adoptee').forEach(adoptee => {
                            // Skip if already processed
                            if (adoptee.querySelector('.adoptee-image-section')) {
                                return;
                            }

                            const img = adoptee.querySelector('img');
                            const name = adoptee.querySelector('.name');
                            const desc = adoptee.querySelector('.description');

                            if (img && name && desc) {
                                // Create image section with name as caption
                                const imageSection = document.createElement('div');
                                imageSection.className = 'adoptee-image-section';

                                // Clone elements to avoid issues
                                const imgClone = img.cloneNode(true);
                                const nameClone = name.cloneNode(true);
                                const descClone = desc.cloneNode(true);

                                // Build image section
                                imageSection.appendChild(imgClone);
                                imageSection.appendChild(nameClone);

                                // Create content wrapper for description only
                                const contentWrapper = document.createElement('div');
                                contentWrapper.className = 'adoptee-content';
                                contentWrapper.appendChild(descClone);

                                // Clear adoptee and rebuild structure
                                adoptee.innerHTML = '';
                                adoptee.appendChild(imageSection);
                                adoptee.appendChild(contentWrapper);
                            }
                        });
                    }, 150);
                }
            }
        }

        // Fix layout after Alpine loads
        document.addEventListener('alpine:init', () => {
            setTimeout(() => {
                document.querySelectorAll('[x-data]').forEach(el => {
                    if (el.__x && el.__x.$data && el.__x.$data.fixContentLayout) {
                        el.__x.$data.fixContentLayout();
                    }
                });
            }, 500);
        });

        // Also fix layout after DOM is fully loaded
        document.addEventListener('DOMContentLoaded', () => {
            setTimeout(() => {
                document.querySelectorAll('[x-data]').forEach(el => {
                    if (el.__x && el.__x.$data && el.__x.$data.fixContentLayout) {
                        el.__x.$data.fixContentLayout();
                    }
                });
            }, 800);
        });
    </script>
@endpush
