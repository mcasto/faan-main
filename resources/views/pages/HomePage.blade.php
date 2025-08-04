@extends('layouts.app')

@section('title', $pageMeta['title'] ?? 'FAAN Foundation')
@section('meta_description', $pageMeta['description'] ?? '')
@section('meta_keywords', $pageMeta['keywords'] ?? '')

@section('content')
    <!-- Hero Section with Background -->
    <div class="bg-cover bg-center min-h-screen relative"
        style="background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('{{ asset('images/home-splash.jpg') }}');">

        <!-- Latest News Banner (Overlay at top) -->
        @if (isset($sections['news']) && is_array($sections['news']) && count($sections['news']) > 0)
            <div id="news-banner"
                class="absolute top-0 left-0 right-0 z-10 bg-gradient-to-r from-blue-600 to-blue-800 text-white py-3 px-4 shadow-lg overflow-hidden news-banner hidden"
                data-latest-news-date="{{ $sections['news_metadata']['latest_start_date'] ?? '' }}"
                style="animation: slideDown 0.6s ease-out;">
                <div class="max-w-6xl mx-auto flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <!-- News Icon -->
                        <div class="bg-blue-900 bg-opacity-40 p-2 rounded-full animate-pulse">
                            <svg class="w-5 h-5 text-yellow-300" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M2 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 002 2H4a2 2 0 01-2-2V5zm3 1h6v4H5V6zm6 6H5v2h6v-2z"
                                    clip-rule="evenodd"></path>
                                <path d="M15 7h1a2 2 0 012 2v5.5a1.5 1.5 0 01-3 0V9a1 1 0 00-1-1h-1v-1z"></path>
                            </svg>
                        </div>
                        <!-- News Text -->
                        <div class="flex-1 min-w-0">
                            <h3 class="font-bold text-base leading-tight">
                                {{ app()->getLocale() === 'es' ? '¡Últimas Noticias!' : 'Latest News!' }}
                            </h3>
                            <p class="text-blue-100 text-xs leading-tight hidden sm:block">
                                {{ app()->getLocale() === 'es'
                                    ? 'Mantente informado sobre nuestras actividades'
                                    : 'Stay updated with our latest activities' }}
                                <span
                                    class="bg-blue-900 bg-opacity-50 text-yellow-200 px-2 py-0.5 rounded-full text-xs ml-2 font-semibold">
                                    {{ count($sections['news']) }}
                                    {{ app()->getLocale() === 'es' ? (count($sections['news']) === 1 ? 'noticia' : 'noticias') : (count($sections['news']) === 1 ? 'item' : 'items') }}
                                </span>
                            </p>
                            <!-- Mobile version - shorter text -->
                            <p class="text-blue-100 text-xs leading-tight sm:hidden">
                                {{ app()->getLocale() === 'es' ? 'Ver noticias' : 'View news' }}
                                <span
                                    class="bg-blue-900 bg-opacity-50 text-yellow-200 px-1 py-0.5 rounded-full text-xs ml-1 font-semibold">
                                    {{ count($sections['news']) }}
                                </span>
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center space-x-2">
                        <!-- Scroll Down Button -->
                        <button onclick="scrollToNews()"
                            class="bg-blue-900 bg-opacity-40 hover:bg-opacity-60 p-2 rounded-full transition duration-300 group flex-shrink-0 hover:scale-110 border border-blue-300 border-opacity-30 cursor-pointer">
                            <svg class="w-5 h-5 text-yellow-300 group-hover:animate-bounce" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                            </svg>
                        </button>

                        <!-- Dismiss Button -->
                        <button onclick="dismissNewsBanner()"
                            class="bg-red-600 bg-opacity-70 hover:bg-opacity-90 p-2 rounded-full transition duration-300 flex-shrink-0 hover:scale-110 border border-red-400 border-opacity-30 cursor-pointer">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Moving gradient animation -->
                <div
                    class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-transparent via-white to-transparent opacity-30">
                    <div class="h-full bg-gradient-to-r from-white via-transparent to-white animate-pulse"></div>
                </div>
            </div>
        @endif

        <div class="min-h-screen flex flex-col justify-center items-center text-white px-4">
            <div class="text-center max-w-4xl mx-auto">
                @if (isset($sections['header']['html']))
                    <div class="mb-8">
                        {!! $sections['header']['html'] !!}
                    </div>
                @else
                    <h1 class="text-4xl md:text-6xl font-bold mb-6">
                        {{ app()->getLocale() === 'es' ? 'Fundación FAAN' : 'FAAN Foundation' }}
                    </h1>
                    <p class="text-xl md:text-2xl mb-8">
                        {{ app()->getLocale() === 'es'
                            ? 'Rescate y Adopción de Animales en Ecuador'
                            : 'Animal Rescue and Adoption in Ecuador' }}
                    </p>
                @endif

                <div class="flex flex-col sm:flex-row gap-4 justify-center mt-8">
                    <a href="/donations"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 px-8 rounded-lg text-lg transition duration-300 shadow-lg">
                        {{ app()->getLocale() === 'es' ? 'Donar Ahora' : 'Donate Now' }}
                    </a>
                    <a href="/adoptions"
                        class="bg-green-600 hover:bg-green-700 text-white font-bold py-4 px-8 rounded-lg text-lg transition duration-300 shadow-lg">
                        {{ app()->getLocale() === 'es' ? 'Adoptar' : 'Adopt a Pet' }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- About/Mission Section -->
    <!-- About Section -->
    <section class="py-16 bg-gray-50">
        <div class="px-4">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-12">
                    @if (isset($sections['footer']['html']))
                        <div class="text-lg leading-relaxed text-gray-700">
                            {!! $sections['footer']['html'] !!}
                        </div>
                    @else
                        <h2 class="text-3xl font-bold text-gray-800 mb-8">
                            {{ app()->getLocale() === 'es' ? 'Nuestra Misión' : 'Our Mission' }}
                        </h2>
                        <p class="text-lg text-gray-600 leading-relaxed">
                            {{ app()->getLocale() === 'es'
                                ? 'La Fundación FAAN se dedica al rescate, cuidado y adopción de animales en Ecuador. Trabajamos incansablemente para proporcionar un hogar seguro y amoroso para los animales necesitados.'
                                : 'FAAN Foundation is dedicated to the rescue, care, and adoption of animals in Ecuador. We work tirelessly to provide a safe and loving home for animals in need.' }}
                        </p>
                    @endif
                </div>
            </div>
    </section>

    <!-- Statistics Section -->
    <section class="py-16 bg-gray-100">
        <div class="px-4">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">
                        {{ app()->getLocale() === 'es' ? 'Nuestro Impacto' : 'Our Impact' }}
                    </h2>
                    <p class="text-lg text-gray-600">
                        {{ app()->getLocale() === 'es' ? 'Más de una década ayudando a los animales' : 'Over a decade of helping animals' }}
                    </p>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                    <div class="bg-white rounded-lg p-6 shadow-md">
                        <div class="text-3xl font-bold text-blue-600 mb-2">2,500+</div>
                        <div class="text-gray-600">
                            {{ app()->getLocale() === 'es' ? 'Animales Rescatados' : 'Animals Rescued' }}
                        </div>
                    </div>
                    <div class="bg-white rounded-lg p-6 shadow-md">
                        <div class="text-3xl font-bold text-green-600 mb-2">1,800+</div>
                        <div class="text-gray-600">
                            {{ app()->getLocale() === 'es' ? 'Adopciones Exitosas' : 'Successful Adoptions' }}</div>
                    </div>
                    <div class="bg-white rounded-lg p-6 shadow-md">
                        <div class="text-3xl font-bold text-purple-600 mb-2">15+</div>
                        <div class="text-gray-600">
                            {{ app()->getLocale() === 'es' ? 'Años de Servicio' : 'Years of Service' }}
                        </div>
                    </div>
                    <div class="bg-white rounded-lg p-6 shadow-md">
                        <div class="text-3xl font-bold text-orange-600 mb-2">50+</div>
                        <div class="text-gray-600">{{ app()->getLocale() === 'es' ? 'Voluntarios' : 'Volunteers' }}</div>
                    </div>
                </div>
            </div>
    </section>

    <!-- News Section -->
    @if (isset($sections['news']) && is_array($sections['news']) && count($sections['news']) > 0)
        <section id="latest-news" class="py-16 bg-white scroll-mt-20">
            <div class="px-4">
                <div class="max-w-6xl mx-auto">
                    <div class="text-center mb-12">
                        <h2 class="text-3xl font-bold text-gray-800 mb-4">
                            {{ app()->getLocale() === 'es' ? 'Últimas Noticias' : 'Latest News' }}
                        </h2>
                        <p class="text-lg text-gray-600">
                            {{ app()->getLocale() === 'es' ? 'Mantente al día con nuestras actividades' : 'Stay updated with our activities' }}
                        </p>
                    </div>

                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach ($sections['news'] as $newsItem => $content)
                            @if (isset($content['html']))
                                <div
                                    class="bg-gray-50 rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                                    <div class="p-6">
                                        {!! $content['html'] !!}
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
        </section>
    @endif

    <!-- Call to Action Section -->
    <section class="py-20 bg-blue-600 text-white">
        <div class="px-4">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-3xl md:text-4xl font-bold mb-6">
                    {{ app()->getLocale() === 'es' ? '¡Únete a Nuestra Misión!' : 'Join Our Mission!' }}
                </h2>
                <p class="text-xl mb-8 text-blue-100">
                    {{ app()->getLocale() === 'es'
                        ? 'Cada donación, cada adopción, cada hora de voluntariado marca la diferencia en la vida de un animal necesitado.'
                        : 'Every donation, every adoption, every volunteer hour makes a difference in the life of an animal in need.' }}
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="/donations"
                        class="bg-white text-blue-600 hover:bg-blue-50 font-bold py-4 px-8 rounded-lg text-lg transition duration-300 shadow-lg hover:shadow-xl">
                        {{ app()->getLocale() === 'es' ? 'Hacer Donación' : 'Make a Donation' }}
                    </a>
                    <a href="/volunteer"
                        class="bg-transparent border-2 border-white text-white hover:bg-white hover:text-blue-600 font-bold py-4 px-8 rounded-lg text-lg transition duration-300">
                        {{ app()->getLocale() === 'es' ? 'Ser Voluntario' : 'Volunteer With Us' }}
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('styles')
    <style>
        /* Custom styles for migrated content */
        .faan-header-text {
            font-size: 2.5rem;
            line-height: 1.2;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
            margin-bottom: 2rem;
        }

        @media (min-width: 768px) {
            .faan-header-text {
                font-size: 4rem;
            }
        }

        /* Ensure responsive text in footer content */
        .text-subtitle1 {
            font-size: 1.125rem;
            line-height: 1.6;
            color: #374151;
        }

        /* Responsive visibility for md-and-up class */
        @media (max-width: 599px) {
            .md-and-up {
                display: none !important;
            }
        }

        /* Smooth hover effects */
        .hover\:scale-105:hover {
            transform: scale(1.05);
        }

        /* News banner animations */
        @keyframes slideDown {
            from {
                transform: translateY(-100%);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes slideUp {
            from {
                transform: translateY(0);
                opacity: 1;
            }

            to {
                transform: translateY(-100%);
                opacity: 0;
            }
        }

        .news-banner {
            animation: slideDown 0.6s ease-out;
        }
    </style>
@endsection

@push('scripts')
    <script>
        // Cookie utility functions
        function setCookie(name, value, days) {
            const expires = new Date();
            expires.setTime(expires.getTime() + (days * 24 * 60 * 60 * 1000));
            document.cookie = name + '=' + value + ';expires=' + expires.toUTCString() + ';path=/';
        }

        function getCookie(name) {
            const nameEQ = name + '=';
            const ca = document.cookie.split(';');
            for (let i = 0; i < ca.length; i++) {
                let c = ca[i];
                while (c.charAt(0) === ' ') c = c.substring(1, c.length);
                if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
            }
            return null;
        }

        // News banner management
        function shouldShowNewsBanner() {
            const banner = document.getElementById('news-banner');
            if (!banner) return false;

            const latestNewsDate = banner.getAttribute('data-latest-news-date');
            if (!latestNewsDate) return false;

            // DEVELOPMENT MODE: Always show banner when there are news items
            return true;

            /* PRODUCTION CODE (commented out):
            const lastVisit = getCookie('faan_last_visit');

            // If no last visit recorded, show banner and record visit
            if (!lastVisit) {
                setCookie('faan_last_visit', new Date().toISOString().split('T')[0], 365);
                return true;
            }

            // Compare last visit with latest news date
            const lastVisitDate = new Date(lastVisit);
            const newsDate = new Date(latestNewsDate);

            // Show banner if there's news that started after their last visit
            return newsDate > lastVisitDate;
            */
        }

        function dismissNewsBanner() {
            const banner = document.getElementById('news-banner');
            if (banner) {
                // Update last visit to today
                setCookie('faan_last_visit', new Date().toISOString().split('T')[0], 365);

                // Animate banner out
                banner.style.animation = 'slideUp 0.4s ease-in';
                setTimeout(() => {
                    banner.style.display = 'none';
                }, 400);
            }
        }

        function scrollToNews() {
            const newsSection = document.getElementById('latest-news');
            if (newsSection) {
                newsSection.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });

                // Add a slight bounce animation to the news section title
                const newsTitle = newsSection.querySelector('h2');
                if (newsTitle) {
                    newsTitle.classList.add('animate-pulse');
                    setTimeout(() => {
                        newsTitle.classList.remove('animate-pulse');
                    }, 2000);
                }
            }

            // Also dismiss the banner since they've seen the news
            setTimeout(() => {
                dismissNewsBanner();
            }, 1000);
        }

        // Initialize banner visibility on page load
        document.addEventListener('DOMContentLoaded', function() {
            if (shouldShowNewsBanner()) {
                const banner = document.getElementById('news-banner');
                if (banner) {
                    banner.classList.remove('hidden');
                }
            }
        });
    </script>
@endpush
