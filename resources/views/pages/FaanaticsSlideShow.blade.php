@extends('layouts.app')

@section('title', $meta['title'] ?? 'FAAN-atics Slide Show - FAAN Foundation')
@section('description', $meta['description'] ?? 'View our volunteer photo slideshow showcasing the amazing work of
    FAAN-atics volunteers')

@section('content')
    <div class="min-h-screen">
        {{-- Hero Section --}}
        @if (isset($sections['hero']))
            <section class="bg-gradient-to-r from-pink-600 to-purple-600 text-white py-20">
                <div class="container mx-auto px-4">
                    <div class="max-w-4xl mx-auto text-center">
                        {!! $sections['hero']['html'] !!}
                    </div>
                </div>
            </section>
        @endif

        {{-- Main Content --}}
        <main class="py-12">
            <div class="container mx-auto px-4">
                <div class="max-w-6xl mx-auto">

                    {{-- Page Title --}}
                    <div class="text-center mb-12">
                        <h1 class="text-4xl font-bold text-gray-900 mb-4">
                            {{ app()->getLocale() === 'es' ? 'Presentación FAAN-áticos' : 'FAAN-atics Slide Show' }}
                        </h1>
                        <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                            {{ app()->getLocale() === 'es'
                                ? 'Mira nuestra presentación de fotos de voluntarios mostrando el increíble trabajo de los voluntarios FAAN-áticos.'
                                : 'View our volunteer photo slideshow showcasing the amazing work of FAAN-atics volunteers.' }}
                        </p>
                    </div>

                    {{-- Slideshow Section --}}
                    @if (isset($sections['slideshow']))
                        <section class="mb-16">
                            <div class="bg-white rounded-lg shadow-lg p-8">
                                {!! $sections['slideshow']['html'] !!}
                            </div>
                        </section>
                    @endif

                    {{-- Volunteer Highlights Section --}}
                    @if (isset($sections['highlights']))
                        <section class="mb-16">
                            <h2 class="text-3xl font-bold text-center mb-12 text-gray-900">
                                {{ app()->getLocale() === 'es' ? 'Destacados de Voluntarios' : 'Volunteer Highlights' }}
                            </h2>
                            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                                {!! $sections['highlights']['html'] !!}
                            </div>
                        </section>
                    @endif

                    {{-- Gallery Section --}}
                    @if (isset($sections['gallery']))
                        <section class="mb-16">
                            <h2 class="text-3xl font-bold text-center mb-12 text-gray-900">
                                {{ app()->getLocale() === 'es' ? 'Galería' : 'Gallery' }}
                            </h2>
                            <div class="bg-gray-50 rounded-lg p-8">
                                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-4">
                                    {!! $sections['gallery']['html'] !!}
                                </div>
                            </div>
                        </section>
                    @endif

                    {{-- Join Us Section --}}
                    @if (isset($sections['join-us']))
                        <section class="bg-pink-50 rounded-lg p-8">
                            <div class="text-center">
                                <h2 class="text-3xl font-bold mb-6 text-gray-900">
                                    {{ app()->getLocale() === 'es' ? 'Únete a Nosotros' : 'Join Us' }}
                                </h2>
                                {!! $sections['join-us']['html'] !!}
                            </div>
                        </section>
                    @endif

                </div>
            </div>
        </main>
    </div>
@endsection
