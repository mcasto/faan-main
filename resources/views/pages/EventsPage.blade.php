@extends('layouts.app')

@section('title', $navigation->name_en . ' - FAAN Foundation')
@section('description', 'FAAN Foundation Events and Activities')

@section('content')
    <div class="w-full events-page">
        <!-- Page Header -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-12 mb-8">
            <div class="container mx-auto px-4">
                <h1 class="text-4xl font-bold mb-4">{{ $locale === 'es' ? $navigation->name_es : $navigation->name_en }}</h1>
                <p class="text-xl text-blue-100">
                    @if (request()->path() === 'events/upcoming-events')
                        {{ $locale === 'es' ? 'Eventos actuales y próximos de FAAN' : 'Current and upcoming FAAN events' }}
                    @else
                        {{ $locale === 'es' ? 'Eventos pasados de FAAN' : 'Past FAAN events' }}
                    @endif
                </p>
            </div>
        </div>

        <!-- Events Content -->
        <div class="container mx-auto px-4">
            @if (isset($events) && $events->count() > 0)
                <div class="grid gap-8 md:gap-12">
                    @foreach ($events as $event)
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden border border-gray-200">
                            <!-- Event Header -->
                            <div class="bg-gradient-to-r from-blue-50 to-blue-100 px-6 py-4 border-b">
                                <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $event->title }}</h2>

                                @if ($event->subtitle)
                                    <p class="text-lg text-gray-600 mb-3">{{ $event->subtitle }}</p>
                                @endif

                                @if (!$event->hide_dates)
                                    <div class="flex flex-wrap gap-4 text-sm text-blue-700">
                                        @if ($event->starts)
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                    </path>
                                                </svg>
                                                <span>
                                                    <strong>{{ $locale === 'es' ? 'Inicio:' : 'Starts:' }}</strong>
                                                    {{ $event->starts->format($locale === 'es' ? 'd/m/Y' : 'M j, Y') }}
                                                </span>
                                            </div>
                                        @endif

                                        @if ($event->expires && $event->expires != $event->starts)
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                    </path>
                                                </svg>
                                                <span>
                                                    <strong>{{ $locale === 'es' ? 'Termina:' : 'Ends:' }}</strong>
                                                    {{ $event->expires->format($locale === 'es' ? 'd/m/Y' : 'M j, Y') }}
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            </div>

                            <!-- Event Content -->
                            <div class="px-6 py-6">
                                @if ($event->content)
                                    <div class="prose prose-lg max-w-none">
                                        {!! $event->content !!}
                                    </div>
                                @else
                                    <p class="text-gray-600 italic">
                                        {{ $locale === 'es' ? 'Detalles del evento próximamente...' : 'Event details coming soon...' }}
                                    </p>
                                @endif
                            </div>

                            <!-- Event Status Badge -->
                            <div class="px-6 pb-4">
                                @php
                                    $now = now();
                                    $isUpcoming = $event->starts > $now;
                                    $isCurrent = $event->starts <= $now && $event->expires >= $now;
                                    $isPast = $event->expires < $now;
                                @endphp

                                @if ($isUpcoming)
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $locale === 'es' ? 'Próximo' : 'Upcoming' }}
                                    </span>
                                @elseif($isCurrent)
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                        </svg>
                                        {{ $locale === 'es' ? 'En curso' : 'Current' }}
                                    </span>
                                @elseif($isPast)
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $locale === 'es' ? 'Finalizado' : 'Completed' }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- No Events Message -->
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                    <h3 class="text-xl font-medium text-gray-600 mb-2">
                        @if (request()->path() === 'events/upcoming-events')
                            {{ $locale === 'es' ? 'No hay eventos actuales o próximos' : 'No current or upcoming events' }}
                        @else
                            {{ $locale === 'es' ? 'No hay eventos pasados registrados' : 'No past events recorded' }}
                        @endif
                    </h3>
                    <p class="text-gray-500">
                        {{ $locale === 'es' ? 'Vuelve pronto para ver nuevos eventos.' : 'Check back soon for new events.' }}
                    </p>
                </div>
            @endif

            <!-- Back to Navigation -->
            <div class="mt-12 text-center">
                <a href="{{ route('home') }}"
                    class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    {{ $locale === 'es' ? 'Volver al inicio' : 'Back to Home' }}
                </a>
            </div>
        </div>
    </div>
@endsection
