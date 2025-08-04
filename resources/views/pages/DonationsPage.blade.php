@extends('layouts.app')

@section('title', $meta['title'] ?? 'Donations - FAAN Foundation')
@section('description',
    $meta['description'] ??
    'Support animal rescue and adoption in Ecuador through donations to FAAN
    Foundation')

@section('content')
    <div class="min-h-screen">
        {{-- Main Content --}}
        <main class="py-12">
            <div class="px-4">
                <div class="max-w-6xl mx-auto">
                    <div class="max-w-6xl mx-auto">

                        {{-- Page Title --}}
                        <div class="text-center mb-12">
                            <h1 class="text-4xl font-bold text-gray-900 mb-4">
                                {{ app()->getLocale() === 'es' ? 'Donaciones' : 'Donations' }}
                            </h1>
                            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                                {{ app()->getLocale() === 'es'
                                    ? 'Tu apoyo hace posible que rescatemos, cuidemos y encontremos hogares para animales abandonados en Ecuador.'
                                    : 'Your support makes it possible for us to rescue, care for, and find homes for abandoned animals in Ecuador.' }}
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

                        {{-- Legal Information --}}
                        @if (isset($sections['legal']))
                            <section class="bg-blue-50 rounded-lg p-8">
                                <div class="text-center">
                                    <h2 class="text-3xl font-bold mb-6 text-gray-900">
                                        {{ app()->getLocale() === 'es' ? 'Información Legal' : 'Legal Information' }}
                                    </h2>
                                    <div class="prose prose-lg max-w-none">
                                        {!! $sections['legal']['html'] !!}
                                    </div>
                                </div>
                            </section>
                        @endif

                        {{-- Donation Form --}}
                        <section class="mt-16">
                            <div class="bg-white rounded-lg shadow-lg p-8">
                                <div class="text-center mb-8">
                                    <h2 class="text-3xl font-bold mb-4 text-gray-900">
                                        {{ app()->getLocale() === 'es' ? 'Formulario de Donación' : 'Donation Form' }}
                                    </h2>
                                    <p class="text-lg text-gray-600">
                                        {{ app()->getLocale() === 'es'
                                            ? 'Este formulario es solo para los registros de FAAN. Necesitamos esta información para realizar un seguimiento adecuado de las donaciones que recibimos.'
                                            : 'This form is only for FAAN\'s records. We need this information to properly track the donations we receive.' }}
                                    </p>
                                </div>

                                @if (session('success'))
                                    <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                @if ($errors->has('donation'))
                                    <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                                        {{ $errors->first('donation') }}
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('donations.submit') }}" class="space-y-6">
                                    @csrf

                                    {{-- Donation Method Selection --}}
                                    <div class="bg-gray-50 p-6 rounded-lg">
                                        <h3 class="text-lg font-semibold text-gray-900 mb-4">
                                            {{ app()->getLocale() === 'es' ? 'Método de Donación' : 'Donation Method' }}
                                        </h3>

                                        <div class="space-y-3">
                                            <label class="inline-flex items-center">
                                                <input type="radio" name="donation_type" value="credit"
                                                    class="form-radio text-blue-600"
                                                    {{ old('donation_type', 'credit') === 'credit' ? 'checked' : '' }}>
                                                <span class="ml-2">
                                                    {{ app()->getLocale() === 'es' ? 'Tarjeta de Crédito / PayPal' : 'Credit Card / PayPal' }}
                                                </span>
                                            </label>

                                            <label class="inline-flex items-center">
                                                <input type="radio" name="donation_type" value="transfer"
                                                    class="form-radio text-blue-600"
                                                    {{ old('donation_type') === 'transfer' ? 'checked' : '' }}>
                                                <span class="ml-2">
                                                    {{ app()->getLocale() === 'es' ? 'Transferencia Bancaria en Ecuador' : 'Bank Transfer in Ecuador' }}
                                                </span>
                                            </label>

                                            <label class="inline-flex items-center">
                                                <input type="radio" name="donation_type" value="pickup"
                                                    class="form-radio text-blue-600"
                                                    {{ old('donation_type') === 'pickup' ? 'checked' : '' }}>
                                                <span class="ml-2">
                                                    {{ app()->getLocale() === 'es' ? 'Recogida por Voluntario de FAAN' : 'Pickup by FAAN Volunteer' }}
                                                </span>
                                            </label>
                                        </div>

                                        @error('donation_type')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    {{-- Personal Information --}}
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                                {{ app()->getLocale() === 'es' ? 'Nombre' : 'Name' }}
                                                <span class="text-red-500">*</span>
                                            </label>
                                            <input type="text" id="name" name="name" value="{{ old('name') }}"
                                                required
                                                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent {{ $errors->has('name') ? 'border-red-500' : 'border-gray-300' }}">
                                            @error('name')
                                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div>
                                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                                {{ app()->getLocale() === 'es' ? 'Correo Electrónico' : 'Email' }}
                                                <span class="text-red-500">*</span>
                                            </label>
                                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                                required
                                                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent {{ $errors->has('email') ? 'border-red-500' : 'border-gray-300' }}">
                                            @error('email')
                                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Donation Amount --}}
                                    <div>
                                        <label for="donation_amount" class="block text-sm font-medium text-gray-700 mb-2">
                                            {{ app()->getLocale() === 'es' ? 'Importe de la Donación ($)' : 'Donation Amount ($)' }}
                                            <span class="text-red-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <span class="absolute left-3 top-2 text-gray-500">$</span>
                                            <input type="number" id="donation_amount" name="donation_amount"
                                                value="{{ old('donation_amount') }}" min="0.01" step="0.01" required
                                                class="w-full pl-8 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent {{ $errors->has('donation_amount') ? 'border-red-500' : 'border-gray-300' }}">
                                        </div>
                                        @error('donation_amount')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    {{-- Consent Checkbox --}}
                                    <div class="flex items-start">
                                        <input type="checkbox" id="consent" name="consent" value="1"
                                            {{ old('consent') ? 'checked' : '' }} required
                                            class="mt-1 form-checkbox text-blue-600 {{ $errors->has('consent') ? 'border-red-500' : '' }}">
                                        <label for="consent" class="ml-3 text-sm text-gray-700">
                                            {{ app()->getLocale() === 'es'
                                                ? 'Doy mi consentimiento para que este sitio web conserve mis datos personales únicamente con fines de comunicación y entiendo que no se compartirán con terceros.'
                                                : 'I consent to have this website hold my personal data solely for communication purposes and understand that it will not be shared with any third parties.' }}
                                            <span class="text-red-500">*</span>
                                        </label>
                                    </div>
                                    @error('consent')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror

                                    {{-- Submit Button --}}
                                    <div class="text-center pt-6">
                                        <button type="submit"
                                            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-lg transition duration-200 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                            {{ app()->getLocale() === 'es' ? 'Continuar' : 'Continue' }}
                                        </button>
                                    </div>

                                    {{-- reCAPTCHa Notice --}}
                                    <div class="text-center text-xs text-gray-500 mt-4">
                                        {{ app()->getLocale() === 'es'
                                            ? 'Este sitio está protegido por reCAPTCHA y se aplican la Política de Privacidad y los Términos de Servicio de Google.'
                                            : 'This site is protected by reCAPTCHA and the Google Privacy Policy and Terms of Service apply.' }}
                                    </div>
                                </form>
                            </div>
                        </section>
                    </div>

                    {{-- Include Donation Modal --}}
                    @include('components.donation-modal')
        </main>
    </div>
@endsection

@push('head')
    <style>
        .paw-image {
            max-width: 120px;
            margin: 10px;
        }

        .paws-carpet-text {
            max-width: 300px;
            font-size: 0.9rem;
            line-height: 1.3;
            color: #4a5568;
        }

        .prose img {
            margin: 0 auto;
            border-radius: 8px;
        }

        .prose address {
            font-style: normal;
            background: #f7fafc;
            padding: 1rem;
            border-left: 4px solid #3182ce;
            margin: 1rem 0;
        }
    </style>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('showDonationModal'))
                // Show modal after successful form submission
                setTimeout(function() {
                    const event = new CustomEvent('open-donation-modal', {
                        detail: {
                            type: '{{ session('showDonationModal') }}'
                        }
                    });
                    document.dispatchEvent(event);
                }, 100);
            @endif
        });
    </script>
@endpush
