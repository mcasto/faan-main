@extends('layouts.app')

@section('title', $meta['title'] ?? 'Gala Faantastica - FAAN Foundation')
@section('description', $meta['description'] ?? 'Join us for our annual Gala Faantastica fundraising event')

@section('content')
    <div class="min-h-screen">
        {{-- Main Content --}}
        <main class="py-12">
            <div class="container mx-auto px-4">
                <div class="max-w-4xl mx-auto text-center">

                    <div class="bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-lg p-16 mb-8">
                        <div class="text-6xl mb-6">🎭</div>
                        <h1 class="text-4xl font-bold mb-4">
                            {{ app()->getLocale() === 'es' ? 'Gala Faantástica' : 'Gala Faantastica' }}
                        </h1>
                        <p class="text-xl mb-8">
                            {{ app()->getLocale() === 'es'
                                ? 'Únete a nosotros en nuestro evento anual de recaudación de fondos Gala Faantástica.'
                                : 'Join us for our annual Gala Faantastica fundraising event.' }}
                        </p>

                        <div class="bg-white/20 rounded-lg p-6 mb-8">
                            <p class="text-lg">
                                {{ app()->getLocale() === 'es'
                                    ? 'Este evento se encuentra en una plataforma externa.'
                                    : 'This event is hosted on an external platform.' }}
                            </p>
                        </div>

                        <a href="https://gala-{{ app()->getLocale() }}.castoware.com" target="_blank"
                            class="inline-block bg-white text-purple-600 font-bold py-3 px-8 rounded-lg hover:bg-gray-100 transition duration-200">
                            {{ app()->getLocale() === 'es' ? 'Visitar Sitio del Evento' : 'Visit Event Site' }}
                            <svg class="inline-block ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                            </svg>
                        </a>
                    </div>

                    {{-- Event Info Section --}}
                    @if (isset($sections['event-info']))
                        <div class="bg-white rounded-lg shadow-lg p-8">
                            {!! $sections['event-info']['html'] !!}
                        </div>
                    @endif

                </div>
            </div>
        </main>
    </div>
@endsection
