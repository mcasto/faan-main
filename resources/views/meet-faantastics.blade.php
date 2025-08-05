@extends('layouts.app')

@section('title', __('meet-faantastics.title'))

@section('content')
    <div class="min-h-screen">
        {{-- Main Content --}}
        <main class="py-12">
            <div class="container mx-auto px-4">
                <div class="max-w-6xl mx-auto">

                    {{-- Page Title --}}
                    <div class="text-center mb-12">
                        <h1 class="text-4xl font-bold text-gray-900 mb-4">
                            {!! $header !!}
                        </h1>
                        <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                            {{ app()->getLocale() === 'es'
                                ? 'Conoce a las personas increíbles que hacen posible la misión de FAAN: nuestros miembros de la junta, equipo del refugio y voluntarios dedicados.'
                                : 'Meet the amazing people who make FAAN\'s mission possible: our board members, shelter team, and dedicated volunteers.' }}
                        </p>
                    </div>

                    <!-- Board Section -->
                    <section class="mb-16">
                        <div class="bg-white rounded-lg shadow-lg p-8">
                            <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">
                                {{ app()->getLocale() === 'es' ? 'Miembros de la Junta' : 'Board Members' }}
                            </h2>
                            <div class="text-gray-700">
                                {!! $boardSection !!}
                            </div>
                        </div>
                    </section>

                    <!-- Team Section -->
                    <section class="mb-16">
                        <div class="bg-white rounded-lg shadow-lg p-8">
                            <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">
                                {{ app()->getLocale() === 'es' ? 'Equipo del Refugio y Voluntarios' : 'Shelter Team & Volunteers' }}
                            </h2>
                            <div class="text-gray-700">
                                {!! $teamSection !!}
                            </div>
                        </div>
                    </section>

                    <!-- Committee Section -->
                    <section class="mb-16">
                        <div class="bg-white rounded-lg shadow-lg p-8">
                            <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">
                                {{ app()->getLocale() === 'es' ? 'Comité de Gala 2025' : '2025 Gala Committee' }}
                            </h2>
                            <div class="text-gray-700">
                                {!! $committeeSection !!}
                            </div>
                        </div>
                    </section>

                </div>
            </div>
        </main>
    </div>
@endsection
