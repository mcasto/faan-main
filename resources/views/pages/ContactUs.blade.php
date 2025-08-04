@extends('layouts.app')

@section('title', $meta['title'] ?? 'Contact Us - FAAN Foundation')
@section('description',
    $meta['description'] ??
    'Get in touch wi </section>
    @endif

    </div>
    </div>
    </main>N Foundation for animal rescue, adoption,
    donations, or volunteering in Ecuador')

@section('content')
    <div class="min-h-screen">
        {{-- Hero Section --}}
        @if (isset($sections['hero']))
            <section class="bg-gradient-to-r from-purple-600 to-pink-600 text-white py-20">
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
                <div class="w-full">

                    {{-- Page Title --}}
                    <div class="text-center mb-12">
                        <h1 class="text-4xl font-bold text-gray-900 mb-4">
                            {{ app()->getLocale() === 'es' ? 'Contáctanos' : 'Contact Us' }}
                        </h1>
                        <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                            {{ app()->getLocale() === 'es'
                                ? 'Ponte en contacto con nosotros para rescate de animales, adopciones, donaciones o voluntariado.'
                                : 'Get in touch with us for animal rescue, adoptions, donations, or volunteering opportunities.' }}
                        </p>
                    </div>

                    {{-- Contact Form - Full Width --}}
                    <div class="w-full mb-12">
                        @if (isset($sections['contact-form']))
                            <div class="bg-white rounded-lg shadow-lg p-8">
                                <h2 class="text-2xl font-bold mb-6 text-gray-900 text-center">
                                    {{ app()->getLocale() === 'es' ? 'Envíanos un Mensaje' : 'Send us a Message' }}
                                </h2>
                                {!! $sections['contact-form']['html'] !!}
                            </div>
                        @else
                            {{-- Default contact form if no migrated content --}}
                            <div class="bg-white rounded-lg shadow-lg p-8">
                                <h2 class="text-2xl font-bold mb-6 text-gray-900 text-center">
                                    {{ app()->getLocale() === 'es' ? 'Envíanos un Mensaje' : 'Send us a Message' }}
                                </h2>

                                @if (session('success'))
                                    <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                @if ($errors->any())
                                    <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                                        <ul class="list-disc list-inside">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('contact.submit') }}" class="space-y-6">
                                    @csrf
                                    <div class="grid md:grid-cols-2 gap-6">
                                        <div>
                                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                                {{ app()->getLocale() === 'es' ? 'Nombre' : 'Name' }} *
                                            </label>
                                            <input type="text" name="name" id="name" required
                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        </div>

                                        <div>
                                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                                {{ app()->getLocale() === 'es' ? 'Correo Electrónico' : 'Email' }} *
                                            </label>
                                            <input type="email" name="email" id="email" required
                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        </div>
                                    </div>

                                    <div>
                                        <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">
                                            {{ app()->getLocale() === 'es' ? 'Asunto' : 'Subject' }} *
                                        </label>
                                        <input type="text" name="subject" id="subject" required
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    </div>

                                    <div>
                                        <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
                                            {{ app()->getLocale() === 'es' ? 'Mensaje' : 'Message' }} *
                                        </label>
                                        <textarea name="message" id="message" rows="6" required
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit"
                                            class="bg-blue-600 text-white py-3 px-8 rounded-lg hover:bg-blue-700 transition duration-200 font-medium">
                                            {{ app()->getLocale() === 'es' ? 'Enviar Mensaje' : 'Send Message' }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        @endif
                    </div>

                    {{-- Contact Information in Full Width Grid --}}
                    <div class="grid lg:grid-cols-3 gap-8">
                        {{-- Contact Information --}}
                        @if (isset($sections['contact-info']))
                            <div class="bg-white rounded-lg shadow-lg p-8">
                                <h2 class="text-2xl font-bold mb-6 text-gray-900">
                                    {{ app()->getLocale() === 'es' ? 'Información de Contacto' : 'Contact Information' }}
                                </h2>
                                {!! $sections['contact-info']['html'] !!}
                            </div>
                        @endif

                        {{-- Office Hours --}}
                        @if (isset($sections['office-hours']))
                            <div class="bg-gray-50 rounded-lg p-8">
                                <h2 class="text-2xl font-bold mb-6 text-gray-900">
                                    {{ app()->getLocale() === 'es' ? 'Horarios de Atención' : 'Office Hours' }}
                                </h2>
                                {!! $sections['office-hours']['html'] !!}
                            </div>
                        @endif

                        {{-- Emergency Contact --}}
                        @if (isset($sections['emergency-contact']))
                            <div class="bg-red-50 border-l-4 border-red-500 rounded-lg p-8">
                                <h2 class="text-2xl font-bold mb-6 text-red-900">
                                    {{ app()->getLocale() === 'es' ? 'Contacto de Emergencia' : 'Emergency Contact' }}
                                </h2>
                                {!! $sections['emergency-contact']['html'] !!}
                            </div>
                        @endif
                    </div>

                    {{-- Location Map Section --}}
                    @if (isset($sections['location-map']))
                        <section class="mt-16">
                            <h2 class="text-3xl font-bold text-center mb-12 text-gray-900">
                                {{ app()->getLocale() === 'es' ? 'Nuestra Ubicación' : 'Our Location' }}
                            </h2>
                            <div class="bg-white rounded-lg shadow-lg p-8">
                                {!! $sections['location-map']['html'] !!}
                            </div>
                        </section>
                    @endif

                </div>
            </div>
        </main>
    </div>
@endsection
