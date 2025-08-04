@extends('layouts.app')

@section('title', $meta['title'] ?? 'Shelter Project - FAAN Foundation')
@section('description', $meta['description'] ?? 'Learn about our animal shelter project in Ecuador. Help us build a safe
    haven for rescued animals')

@section('content')
    <div class="min-h-screen">
        {{-- Main Content --}}
        <main class="py-12">
            <div class="container mx-auto px-4">
                <div class="max-w-6xl mx-auto">

                    {{-- Page Title --}}
                    <div class="text-center mb-12">
                        <h1 class="text-4xl font-bold text-gray-900 mb-4">
                            {{ app()->getLocale() === 'es' ? 'Proyecto de Refugio' : 'Shelter Project' }}
                        </h1>
                        <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                            {{ app()->getLocale() === 'es'
                                ? 'Conoce nuestro proyecto de refugio para animales en Ecuador. Ayúdanos a construir un hogar seguro para animales rescatados.'
                                : 'Learn about our animal shelter project in Ecuador. Help us build a safe haven for rescued animals.' }}
                        </p>
                    </div>

                    {{-- Main Page Content --}}
                    @if (isset($sections['page']))
                        <section class="mb-16">
                            <div class="bg-white rounded-lg shadow-lg p-8">
                                <div class="prose prose-lg max-w-none">
                                    {!! $sections['page']['html'] !!}
                                </div>
                            </div>
                        </section>
                    @endif

                </div>
            </div>
        </main>
    </div>
@endsection

@push('head')
    <style>
        .prose img {
            margin: 0 auto;
            border-radius: 8px;
            max-width: 100%;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .prose h1,
        .prose h2,
        .prose h3 {
            color: #2d3748;
        }

        .prose a {
            color: #3182ce;
            text-decoration: none;
        }

        .prose a:hover {
            text-decoration: underline;
        }
    </style>
@endpush
