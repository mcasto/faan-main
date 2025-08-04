@extends('layouts.app')

@section('title', $meta['title'] ?? 'Volunteering - FAAN Foundation')
@section('description',
    $meta['description'] ??
    'Join our volunteer team to help rescue and care for animals in Ecuador.
    Make a difference in animal welfare')

@section('content')
    <div class="min-h-screen">
        {{-- Main Content --}}
        <main class="py-12">
            <div class="container mx-auto px-4">
                <div class="max-w-6xl mx-auto">

                    {{-- Page Title --}}
                    <div class="text-center mb-12">
                        <h1 class="text-4xl font-bold text-gray-900 mb-4">
                            {{ app()->getLocale() === 'es' ? 'Voluntariado' : 'Volunteering' }}
                        </h1>
                        <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                            {{ app()->getLocale() === 'es'
                                ? 'Únete a nuestro equipo de voluntarios y ayuda a rescatar y cuidar animales en Ecuador. Haz la diferencia en el bienestar animal.'
                                : 'Join our volunteer team and help rescue and care for animals in Ecuador. Make a difference in animal welfare.' }}
                        </p>
                    </div>

                    {{-- List Header --}}
                    @if (isset($sections['list-header']))
                        <section class="mb-16">
                            <div class="bg-blue-50 rounded-lg p-8">
                                <div class="prose prose-lg max-w-none">
                                    {!! $sections['list-header']['html'] !!}
                                </div>
                            </div>
                        </section>
                    @endif

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

                    {{-- Education Section --}}
                    @if (isset($sections['education']))
                        <section class="mb-16">
                            <h2 class="text-3xl font-bold text-center mb-12 text-gray-900">
                                {{ app()->getLocale() === 'es' ? 'Educación y Capacitación' : 'Education and Training' }}
                            </h2>
                            <div class="bg-gray-50 rounded-lg p-8">
                                <div class="prose prose-lg max-w-none">
                                    {!! $sections['education']['html'] !!}
                                </div>
                            </div>
                        </section>
                    @endif

                    {{-- Volunteer Photos --}}
                    @if (isset($sections['volPhotos']))
                        <section class="mb-16">
                            <h2 class="text-3xl font-bold text-center mb-12 text-gray-900">
                                {{ app()->getLocale() === 'es' ? 'Nuestros Voluntarios en Acción' : 'Our Volunteers in Action' }}
                            </h2>
                            <div class="w-full max-w-none">
                                <div class="prose prose-lg max-w-none volunteer-photos-section">
                                    {!! $sections['volPhotos']['html'] !!}
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

        .volunteer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .volunteer-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .volunteer-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -3px rgba(0, 0, 0, 0.1);
        }

        /* Volunteer Photos Section Specific Styles */
        .volunteer-photos-section .volunteer-images {
            display: grid;
            grid-template-columns: 1fr;
            /* 1 column on xs */
            gap: 1rem;
        }

        /* 2 columns on sm screens */
        @media (min-width: 640px) {
            .volunteer-photos-section .volunteer-images {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        /* 4 columns on md+ screens */
        @media (min-width: 768px) {
            .volunteer-photos-section .volunteer-images {
                grid-template-columns: repeat(4, 1fr);
            }
        }

        /* Ensure all images in volunteer section have same height */
        .volunteer-photos-section .volunteer-images img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .volunteer-photos-section .volunteer-images img:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 15px -3px rgba(0, 0, 0, 0.2);
        }

        /* Override flexbox classes from content with grid */
        .volunteer-photos-section .flex.flex-wrap {
            display: grid !important;
        }

        .volunteer-photos-section .w-full.md\:w-1\/4 {
            width: auto !important;
        }
    </style>
@endpush
