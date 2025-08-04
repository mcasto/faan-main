@extends('layouts.app')

@section('title', $meta['title'] ?? 'Legacy Giving - FAAN Foundation')
@section('description',
    $meta['description'] ??
    'Create a lasting legacy for animal welfare in Ecuador through planned
    giving to FAAN Foundation')

@section('content')
    <div class="min-h-screen">
        {{-- Main Content --}}
        <main class="py-12">
            <div class="container mx-auto px-4">
                <div class="max-w-6xl mx-auto">

                    {{-- Page Title --}}
                    <div class="text-center mb-12">
                        <h1 class="text-4xl font-bold text-gray-900 mb-4">
                            {{ app()->getLocale() === 'es' ? 'Donaciones Testamentarias' : 'Legacy Giving' }}
                        </h1>
                        <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                            {{ app()->getLocale() === 'es'
                                ? 'Crea un legado duradero para el bienestar animal en Ecuador a través de donaciones planificadas a la Fundación FAAN.'
                                : 'Create a lasting legacy for animal welfare in Ecuador through planned giving to FAAN Foundation.' }}
                        </p>
                    </div>

                    {{-- Main Page Content --}}
                    @if (isset($sections['page']))
                        <section class="mb-16">
                            <div class="prose prose-lg max-w-none">
                                {!! $sections['page']['html'] !!}
                            </div>
                        </section>
                    @endif

                    {{-- Legacy Giving Guide --}}
                    @if (isset($sections['guide']))
                        <section class="mb-16">
                            <div class="bg-gray-50 rounded-lg p-8">
                                <h2 class="text-3xl font-bold text-center mb-8 text-gray-900">
                                    {{ app()->getLocale() === 'es' ? 'Guía de Donaciones Planificadas' : 'Planned Giving Guide' }}
                                </h2>
                                <div class="prose prose-lg max-w-none">
                                    {!! $sections['guide']['html'] !!}
                                </div>
                            </div>
                        </section>
                    @endif

                    {{-- Legacy Giving Form --}}
                    <section class="bg-gradient-to-r from-purple-50 to-indigo-50 rounded-lg p-8 mt-12">
                        <div class="max-w-4xl mx-auto">
                            <h2 class="text-3xl font-bold text-center mb-8 text-gray-900">
                                {{ app()->getLocale() === 'es' ? 'Formulario de Donación Testamentaria e Intención de Donación Planificada' : 'Legacy Donation and Planned Giving Intention' }}
                            </h2>

                            {{-- Success Message --}}
                            @if (session('success'))
                                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6"
                                    role="alert">
                                    <span class="block sm:inline">{{ session('success') }}</span>
                                </div>
                            @endif

                            {{-- Error Messages --}}
                            @if ($errors->any())
                                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6"
                                    role="alert">
                                    <ul class="list-disc list-inside">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('donations.submit') }}" method="POST" class="space-y-6"
                                x-data="{
                                    submitting: false,
                                    donationType: '{{ old('donation_type', '') }}'
                                }" @submit="submitting = true"
                                :class="{ 'opacity-50 pointer-events-none': submitting }">
                                @csrf
                                <input type="hidden" name="type" value="legacy_giving">

                                <div class="grid md:grid-cols-2 gap-6">
                                    {{-- Name --}}
                                    <div>
                                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                            {{ app()->getLocale() === 'es' ? 'Nombre legal del donante' : 'Legal Name of Donor' }}
                                            *
                                        </label>
                                        <input type="text" id="name" name="name" required
                                            value="{{ old('name') }}"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-purple-500 focus:border-purple-500">
                                    </div>

                                    {{-- Phone --}}
                                    <div>
                                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                                            {{ app()->getLocale() === 'es' ? 'Número de Teléfono' : 'Phone Number' }} *
                                        </label>
                                        <input type="tel" id="phone" name="phone" required
                                            value="{{ old('phone') }}"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-purple-500 focus:border-purple-500">
                                    </div>

                                    {{-- Document Number --}}
                                    <div>
                                        <label for="doc_num" class="block text-sm font-medium text-gray-700 mb-2">
                                            {{ app()->getLocale() === 'es' ? 'Cédula o Número de Pasaporte' : 'Cédula or Passport Number' }}
                                            *
                                        </label>
                                        <input type="text" id="doc_num" name="doc_num" required
                                            value="{{ old('doc_num') }}"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-purple-500 focus:border-purple-500">
                                    </div>

                                    {{-- Email --}}
                                    <div>
                                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                            {{ app()->getLocale() === 'es' ? 'Correo Electrónico' : 'Email' }} *
                                        </label>
                                        <input type="email" id="email" name="email" required
                                            value="{{ old('email') }}"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-purple-500 focus:border-purple-500">
                                    </div>
                                </div>

                                {{-- Address --}}
                                <div>
                                    <label for="address" class="block text-sm font-medium text-gray-700 mb-2">
                                        {{ app()->getLocale() === 'es' ? 'Dirección' : 'Address' }} *
                                    </label>
                                    <textarea id="address" name="address" rows="3" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-purple-500 focus:border-purple-500">{{ old('address') }}</textarea>
                                </div>

                                {{-- Special Instructions --}}
                                <div>
                                    <label for="special_instructions" class="block text-sm font-medium text-gray-700 mb-2">
                                        {{ app()->getLocale() === 'es' ? 'Instrucciones especiales' : 'Special Instructions' }}
                                    </label>
                                    <textarea id="special_instructions" name="special_instructions" rows="3"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-purple-500 focus:border-purple-500">{{ old('special_instructions') }}</textarea>
                                </div>

                                {{-- Recognition Checkbox --}}
                                <div class="flex items-center">
                                    <input type="checkbox" id="recognized" name="recognized" value="1"
                                        {{ old('recognized') ? 'checked' : '' }}
                                        class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                                    <label for="recognized" class="ml-2 block text-sm text-gray-700">
                                        {{ app()->getLocale() === 'es' ? 'Me gustaría ser reconocido como miembro de la Sociedad Legal de FAAN' : "I would like to be recognized as a member of FAAN's Legal Society" }}
                                    </label>
                                </div>

                                {{-- Donation Type --}}
                                <div x-data="{ donationType: '{{ old('donation_type', '') }}' }">
                                    <label for="donation_type" class="block text-sm font-medium text-gray-700 mb-2">
                                        {{ app()->getLocale() === 'es' ? 'Seleccione el tipo de donación' : 'Select Donation Type' }}
                                        *
                                    </label>
                                    <select id="donation_type" name="donation_type" required x-model="donationType"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-purple-500 focus:border-purple-500">
                                        <option value="">
                                            {{ app()->getLocale() === 'es' ? 'Seleccione una opción' : 'Select an option' }}
                                        </option>
                                        <option value="fixed" {{ old('donation_type') == 'fixed' ? 'selected' : '' }}>
                                            {{ app()->getLocale() === 'es' ? 'Legado directo (importe fijo en $)' : 'Outright Bequest (Fixed $ Amount)' }}
                                        </option>
                                        <option value="percentage"
                                            {{ old('donation_type') == 'percentage' ? 'selected' : '' }}>
                                            {{ app()->getLocale() === 'es' ? 'Legado directo (% del patrimonio)' : 'Outright Bequest (% of Estate)' }}
                                        </option>
                                        <option value="specific"
                                            {{ old('donation_type') == 'specific' ? 'selected' : '' }}>
                                            {{ app()->getLocale() === 'es' ? 'Donación de activos específicos' : 'Donation of Specific Assets' }}
                                        </option>
                                    </select>

                                    {{-- Conditional Donation Info Fields --}}
                                    {{-- Fixed Amount --}}
                                    <div x-show="donationType === 'fixed'" x-transition class="mt-4">
                                        <label for="donation_info_fixed"
                                            class="block text-sm font-medium text-gray-700 mb-2">
                                            {{ app()->getLocale() === 'es' ? 'Legado directo (importe fijo en $)' : 'Outright Bequest (Fixed $ Amount)' }}
                                        </label>
                                        <input type="text" id="donation_info_fixed" name="donation_info"
                                            placeholder="$0.00" value="{{ old('donation_info') }}"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-purple-500 focus:border-purple-500">
                                    </div>

                                    {{-- Percentage --}}
                                    <div x-show="donationType === 'percentage'" x-transition class="mt-4">
                                        <label for="donation_info_percentage"
                                            class="block text-sm font-medium text-gray-700 mb-2">
                                            {{ app()->getLocale() === 'es' ? 'Legado directo (% del patrimonio)' : 'Outright Bequest (% of Estate)' }}
                                        </label>
                                        <input type="text" id="donation_info_percentage" name="donation_info"
                                            placeholder="0%" value="{{ old('donation_info') }}"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-purple-500 focus:border-purple-500">
                                    </div>

                                    {{-- Specific Assets --}}
                                    <div x-show="donationType === 'specific'" x-transition class="mt-4">
                                        <label for="donation_info_specific"
                                            class="block text-sm font-medium text-gray-700 mb-2">
                                            {{ app()->getLocale() === 'es' ? 'Donación de activos específicos' : 'Donation of Specific Assets' }}
                                        </label>
                                        <textarea id="donation_info_specific" name="donation_info" rows="4"
                                            placeholder="{{ app()->getLocale() === 'es' ? 'Describa los activos específicos...' : 'Describe the specific assets...' }}"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-purple-500 focus:border-purple-500">{{ old('donation_info') }}</textarea>
                                    </div>
                                </div>

                                {{-- Consent Checkbox --}}
                                <div class="flex items-start">
                                    <input type="checkbox" id="consent" name="consent" required
                                        {{ old('consent') ? 'checked' : '' }}
                                        class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded mt-1">
                                    <label for="consent" class="ml-2 block text-sm text-gray-700">
                                        {{ app()->getLocale() === 'es' ? 'Doy mi consentimiento para que este sitio web conserve mis datos personales únicamente con fines de comunicación y entiendo que no se compartirán con terceros.' : 'I consent to have this website hold my personal data solely for communication purposes and understand that it will not be shared with any third parties.' }}
                                        *
                                    </label>
                                </div>

                                {{-- Submit Button --}}
                                <div class="text-center">
                                    <button type="submit" :disabled="submitting"
                                        class="bg-purple-600 hover:bg-purple-700 disabled:opacity-50 disabled:cursor-not-allowed text-white font-semibold py-3 px-8 rounded-lg transition-colors duration-200 shadow-lg relative">
                                        <span x-show="!submitting">
                                            {{ app()->getLocale() === 'es' ? 'Enviar' : 'Submit' }}
                                        </span>
                                        <span x-show="submitting" class="flex items-center justify-center">
                                            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                                    stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor"
                                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                                </path>
                                            </svg>
                                            {{ app()->getLocale() === 'es' ? 'Enviando...' : 'Submitting...' }}
                                        </span>
                                    </button>
                                </div>

                                {{-- reCAPTCHA Notice --}}
                                <div class="text-xs text-gray-500 text-center">
                                    This site is protected by reCAPTCHA and the Google
                                    <a href="https://policies.google.com/privacy"
                                        class="text-purple-600 hover:text-purple-700">Privacy Policy</a>
                                    and
                                    <a href="https://policies.google.com/terms"
                                        class="text-purple-600 hover:text-purple-700">Terms of Service</a>
                                    apply.
                                </div>
                            </form>
                        </div>
                    </section>

                    {{-- Include reCAPTCHA v3 Component --}}
                    @include('components.recaptcha-v3', [
                        'autoInit' => [
                            'form[action*="donations.submit"]' => 'legacy_giving_submit',
                        ],
                    ])

                    {{-- Contact for Legacy Giving Section --}}
                    <section class="bg-white rounded-lg shadow-lg p-8 mt-12">
                        <div class="text-center">
                            <h2 class="text-3xl font-bold mb-6 text-gray-900">
                                {{ app()->getLocale() === 'es' ? 'Contacto para Donaciones Testamentarias' : 'Legacy Giving Contact' }}
                            </h2>
                            <p class="text-lg text-gray-600 mb-6">
                                {{ app()->getLocale() === 'es'
                                    ? 'Para obtener más información sobre las donaciones testamentarias, contáctanos.'
                                    : 'For more information about legacy giving, contact us.' }}
                            </p>
                            <a href="/contact-us"
                                class="inline-block bg-purple-600 hover:bg-purple-700 text-white font-semibold py-3 px-8 rounded-lg transition-colors duration-200">
                                {{ app()->getLocale() === 'es' ? 'Contáctanos' : 'Contact Us' }}
                            </a>
                        </div>
                    </section>

                </div>
            </div>
        </main>
    </div>
@endsection
