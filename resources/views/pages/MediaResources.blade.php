@extends('layouts.app')

@section('title', $meta['title'] ?? 'Media Resources - FAAN Foundation')
@section('description',
    $meta['description'] ??
    'Download photos, videos, and press materials about FAAN Foundation
    animal rescue work in Ecuador')

@section('content')
    <div class="min-h-screen">
        {{-- Main Content --}}
        <main class="py-12">
            <div class="container mx-auto px-4">
                <div class="max-w-6xl mx-auto">

                    {{-- Page Title --}}
                    <div class="text-center mb-12">
                        <h1 class="text-4xl font-bold text-gray-900 mb-4">
                            {{ app()->getLocale() === 'es' ? 'Recursos de Medios' : 'Media Resources' }}
                        </h1>
                        <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                            {{ app()->getLocale() === 'es'
                                ? 'Descarga fotos, videos y materiales de prensa sobre el trabajo de rescate animal de la Fundación FAAN en Ecuador.'
                                : 'Download photos, videos, and press materials about FAAN Foundation animal rescue work in Ecuador.' }}
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

                    {{-- Resource Links Grid --}}
                    @if (isset($sections['page']['config']))
                        <section class="mb-16">
                            <h2 class="text-3xl font-bold text-center mb-12 text-gray-900">
                                {{ app()->getLocale() === 'es' ? 'Recursos y Enlaces' : 'Resources & Links' }}
                            </h2>
                            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                                @foreach ($sections['page']['config'] as $sectionKey => $section)
                                    @if (isset($section['type']) && $section['type'] === 'list' && !empty($section['items']))
                                        <div class="bg-white rounded-lg shadow-lg p-6">
                                            <h3 class="text-xl font-bold mb-4 text-gray-900">{{ $section['label'] }}</h3>
                                            <ul class="space-y-2">
                                                @foreach ($section['items'] as $item)
                                                    @if (!isset($item['hidden']) || !$item['hidden'])
                                                        <li>
                                                            <a href="{{ $item['url'] }}"
                                                                target="{{ str_starts_with($item['url'], 'http') ? '_blank' : '_self' }}"
                                                                class="text-blue-600 hover:text-blue-800 hover:underline transition-colors">
                                                                {{ $item['label'] }}
                                                                @if (str_starts_with($item['url'], 'http'))
                                                                    <svg class="w-4 h-4 inline ml-1" fill="none"
                                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                                            stroke-width="2"
                                                                            d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14">
                                                                        </path>
                                                                    </svg>
                                                                @endif
                                                            </a>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </section>
                    @endif

                    {{-- Photo Gallery Carousel --}}
                    @if (isset($sections['page']['config']['gallery']))
                        @php
                            $gallery = $sections['page']['config']['gallery'];
                        @endphp
                        <section>
                            <h2 class="text-3xl font-bold text-center mb-8 text-gray-900">
                                {{ $gallery['label'] }}
                            </h2>
                            <div class="bg-white rounded-lg shadow-lg p-8">
                                <div x-data="{
                                    currentSlide: 0,
                                    autoplay: true,
                                    images: {{ json_encode($gallery['items']) }},
                                    nextSlide() {
                                        this.currentSlide = (this.currentSlide + 1) % this.images.length;
                                    },
                                    prevSlide() {
                                        this.currentSlide = this.currentSlide === 0 ? this.images.length - 1 : this.currentSlide - 1;
                                    },
                                    startAutoplay() {
                                        if (this.autoplay) {
                                            this.interval = setInterval(() => this.nextSlide(), 4000);
                                        }
                                    },
                                    stopAutoplay() {
                                        clearInterval(this.interval);
                                    }
                                }" x-init="startAutoplay()" @mouseenter="stopAutoplay()"
                                    @mouseleave="startAutoplay()" class="relative">

                                    {{-- Carousel Container --}}
                                    <div class="relative h-96 overflow-hidden rounded-lg">
                                        <template x-for="(image, index) in images" :key="index">
                                            <div x-show="currentSlide === index"
                                                x-transition:enter="transition ease-out duration-300"
                                                x-transition:enter-start="opacity-0 transform translate-x-full"
                                                x-transition:enter-end="opacity-100 transform translate-x-0"
                                                x-transition:leave="transition ease-in duration-300"
                                                x-transition:leave-start="opacity-100 transform translate-x-0"
                                                x-transition:leave-end="opacity-0 transform -translate-x-full"
                                                class="absolute inset-0 flex items-center justify-center">
                                                <img :src="image" :alt="`Gallery image ${index + 1}`"
                                                    class="max-h-full max-w-full object-contain">
                                            </div>
                                        </template>
                                    </div>

                                    {{-- Navigation Arrows --}}
                                    <button @click="prevSlide()"
                                        class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 hover:bg-opacity-75 text-white p-2 rounded-full cursor-pointer transition-all">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 19l-7-7 7-7"></path>
                                        </svg>
                                    </button>
                                    <button @click="nextSlide()"
                                        class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 hover:bg-opacity-75 text-white p-2 rounded-full cursor-pointer transition-all">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </button>

                                    {{-- Slide Indicators --}}
                                    <div class="flex justify-center mt-4 space-x-2">
                                        <template x-for="(image, index) in images" :key="index">
                                            <button @click="currentSlide = index"
                                                :class="currentSlide === index ? 'bg-blue-600' : 'bg-gray-300'"
                                                class="w-3 h-3 rounded-full cursor-pointer transition-all hover:bg-blue-400">
                                            </button>
                                        </template>
                                    </div>
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

        .supporter-list {
            margin: 0;
            list-style-image: url('/images/list-paw.png');
        }

        .max-20vw {
            max-width: 20vw;
            margin-right: 1rem;
            padding: 1rem;
        }
    </style>
@endpush
