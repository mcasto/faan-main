@extends('layouts.app')

@section('title', $meta['title'] ?? 'View PDF - FAAN Foundation')
@section('description', $meta['description'] ?? 'View PDF documents and resources from FAAN Foundation')

@section('content')
    <div class="min-h-screen">
        {{-- Main Content --}}
        <main class="py-12">
            <div class="container mx-auto px-4">
                <div class="max-w-6xl mx-auto">

                    {{-- Page Title --}}
                    <div class="text-center mb-12">
                        <h1 class="text-4xl font-bold text-gray-900 mb-4">
                            {{ app()->getLocale() === 'es' ? 'Ver PDF' : 'View PDF' }}
                        </h1>
                        <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                            {{ app()->getLocale() === 'es'
                                ? 'Ver documentos PDF y recursos de la Fundación FAAN.'
                                : 'View PDF documents and resources from FAAN Foundation.' }}
                        </p>
                    </div>

                    {{-- PDF Viewer Section --}}
                    @if (isset($sections['pdf-viewer']))
                        <section class="mb-16">
                            <div class="bg-white rounded-lg shadow-lg p-8">
                                {!! $sections['pdf-viewer']['html'] !!}
                            </div>
                        </section>
                    @endif

                    {{-- Document List Section --}}
                    @if (isset($sections['documents']))
                        <section class="mb-16">
                            <h2 class="text-3xl font-bold text-center mb-12 text-gray-900">
                                {{ app()->getLocale() === 'es' ? 'Documentos Disponibles' : 'Available Documents' }}
                            </h2>
                            <div class="bg-gray-50 rounded-lg p-8">
                                {!! $sections['documents']['html'] !!}
                            </div>
                        </section>
                    @endif

                    {{-- Default PDF Message if no content --}}
                    @if (!isset($sections['pdf-viewer']) && !isset($sections['documents']))
                        <section class="text-center">
                            <div class="bg-gray-100 rounded-lg p-16">
                                <div class="text-6xl mb-6">📄</div>
                                <h2 class="text-2xl font-bold text-gray-700 mb-4">
                                    {{ app()->getLocale() === 'es' ? 'No hay PDF para mostrar' : 'No PDF to display' }}
                                </h2>
                                <p class="text-gray-600">
                                    {{ app()->getLocale() === 'es'
                                        ? 'Por favor selecciona un documento desde el menú de navegación.'
                                        : 'Please select a document from the navigation menu.' }}
                                </p>
                            </div>
                        </section>
                    @endif

                </div>
            </div>
        </main>
    </div>
@endsection
