<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'FAAN Foundation')</title>
    <meta name="description" content="@yield('description', 'Animal Rescue and Adoption in Ecuador')">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('head')
</head>

<body class="font-sans antialiased">
    <div id="app" class="min-h-screen bg-gray-100 md:flex">
        <!-- Sidebar Navigation -->
        <div id="sidebar"
            class="fixed inset-y-0 left-0 z-50 w-64 bg-white shadow-lg transform -translate-x-full transition-transform duration-300 ease-in-out md:translate-x-0 flex flex-col">
            <!-- Sidebar Header with Logo -->
            <div class="flex items-center justify-between p-4 border-b flex-shrink-0">
                <a href="{{ route('home') }}" class="flex items-center">
                    <img src="{{ asset('images/faan-logo.png') }}" alt="FAAN Logo" class="h-12 w-auto">
                </a>
                <!-- Close button for mobile -->
                <button id="closeSidebar"
                    class="md:hidden p-1 rounded-md text-gray-400 hover:text-gray-600 hover:bg-gray-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>

            <!-- Language Switcher in Sidebar -->
            <div class="px-4 py-3 bg-blue-50 border-b flex-shrink-0">
                <div class="flex items-center justify-center space-x-2 text-sm">
                    @if (app()->getLocale() === 'en')
                        <span class="text-gray-600">Language:</span>
                    @else
                        <span class="text-gray-600">Idioma:</span>
                    @endif
                    @if (app()->getLocale() === 'en')
                        <span class="text-blue-600 font-semibold">English</span>
                        <span class="text-gray-400">|</span>
                        <a href="{{ route('set-language', 'es') }}" class="text-blue-600 hover:underline">Español</a>
                    @else
                        <a href="{{ route('set-language', 'en') }}" class="text-blue-600 hover:underline">English</a>
                        <span class="text-gray-400">|</span>
                        <span class="text-blue-600 font-semibold">Español</span>
                    @endif
                </div>
            </div>

            <!-- Navigation Tree -->
            <nav class="flex-1 overflow-y-auto p-4">
                <ul class="space-y-2">
                    @if (isset($navigationMenu))
                        @foreach ($navigationMenu as $item)
                            <li>
                                @if ($item->children && $item->children->count() > 0)
                                    <!-- Parent item with children -->
                                    <div class="nav-parent">
                                        <button
                                            class="nav-toggle w-full flex items-center justify-between p-2 text-left text-gray-700 hover:bg-gray-100 rounded-md transition-colors">
                                            <span class="font-medium">{{ $item->display_name }}</span>
                                            <svg class="w-4 h-4 transform transition-transform nav-arrow" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </button>
                                        <ul class="nav-children ml-4 mt-1 space-y-1 hidden">
                                            @foreach ($item->children as $child)
                                                @if ($child->visible)
                                                    <li>
                                                        <a href="{{ $child->external ? $child->path : ($child->path ?: '#') }}"
                                                            @if ($child->external && $child->external_blank) target="_blank" @endif
                                                            class="block p-2 text-sm text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-md transition-colors {{ request()->path() === ltrim($child->path, '/') ? 'nav-active' : '' }}">
                                                            {{ app()->getLocale() === 'es' ? $child->name_es : $child->name_en }}
                                                            @if ($child->external && $child->external_blank)
                                                                <svg class="w-3 h-3 inline ml-1" fill="none"
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
                                @else
                                    <!-- Single navigation item -->
                                    <a href="{{ $item->external ? $item->path : ($item->path ?: '#') }}"
                                        @if ($item->external && $item->external_blank) target="_blank" @endif
                                        class="block p-2 text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-md font-medium transition-colors {{ request()->path() === ltrim($item->path, '/') ? 'nav-active' : '' }}">
                                        {{ $item->display_name }}
                                        @if ($item->external && $item->external_blank)
                                            <svg class="w-4 h-4 inline ml-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14">
                                                </path>
                                            </svg>
                                        @endif
                                    </a>
                                @endif
                            </li>
                        @endforeach
                    @else
                        <!-- Fallback simple navigation -->
                        <li>
                            <a href="{{ route('home') }}"
                                class="block p-2 text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-md font-medium transition-colors {{ request()->path() === '/' ? 'nav-active' : '' }}">
                                {{ app()->getLocale() === 'es' ? 'Inicio' : 'Home' }}
                            </a>
                        </li>
                        <li>
                            <a href="/donations"
                                class="block p-2 text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-md font-medium transition-colors {{ request()->path() === 'donations' ? 'nav-active' : '' }}">
                                {{ app()->getLocale() === 'es' ? 'Donaciones' : 'Donations' }}
                            </a>
                        </li>
                        <li>
                            <a href="/adoptions"
                                class="block p-2 text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-md font-medium transition-colors {{ request()->path() === 'adoptions' ? 'nav-active' : '' }}">
                                {{ app()->getLocale() === 'es' ? 'Adopciones' : 'Adoptions' }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('meet-faantastics') }}"
                                class="block p-2 text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-md font-medium transition-colors {{ request()->path() === 'meet-faantastics' ? 'nav-active' : '' }}">
                                {{ __('common.navigation.meet_faantastics') }}
                            </a>
                        </li>
                        <li>
                            <a href="/contact-us"
                                class="block p-2 text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-md font-medium transition-colors {{ request()->path() === 'contact-us' ? 'nav-active' : '' }}">
                                {{ app()->getLocale() === 'es' ? 'Contáctenos' : 'Contact Us' }}
                            </a>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>

        <!-- Overlay for mobile -->
        <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden md:hidden"></div>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col min-h-screen md:ml-64">
            <!-- Top Bar for Mobile -->
            <div
                class="md:hidden bg-white shadow-sm border-b px-4 py-3 flex items-center justify-between fixed top-0 left-0 right-0 z-30">
                <button id="openSidebar" class="p-2 rounded-md text-gray-400 hover:text-gray-600 hover:bg-gray-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <a href="{{ route('home') }}" class="flex items-center">
                    <img src="{{ asset('images/faan-logo.png') }}" alt="FAAN Logo" class="h-8 w-auto">
                </a>
                <div class="w-10"></div> <!-- Spacer for centering -->
            </div>

            <!-- Main Content -->
            <main class="flex-1 p-4 md:p-6 w-full overflow-y-auto md:pt-6 pt-20">
                <div class="w-full max-w-full mx-auto">
                    @yield('content')
                </div>
            </main>

            <!-- Simple Footer -->
            <footer class="bg-gray-800 text-white py-8 mt-auto">
                <div class="container mx-auto px-4 text-center">
                    <p>&copy; {{ date('Y') }} FAAN Foundation. All rights reserved.</p>
                </div>
            </footer>
        </div>
    </div>

    <!-- JavaScript for sidebar functionality -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            const openSidebar = document.getElementById('openSidebar');
            const closeSidebar = document.getElementById('closeSidebar');

            // Open sidebar (mobile)
            if (openSidebar) {
                openSidebar.addEventListener('click', function() {
                    sidebar.classList.remove('-translate-x-full');
                    overlay.classList.remove('hidden');
                    document.body.classList.add('overflow-hidden');
                });
            }

            // Close sidebar (mobile)
            function closeSidebarFunc() {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }

            if (closeSidebar) {
                closeSidebar.addEventListener('click', closeSidebarFunc);
            }

            if (overlay) {
                overlay.addEventListener('click', closeSidebarFunc);
            }

            // Handle navigation tree toggles
            const navToggles = document.querySelectorAll('.nav-toggle');
            navToggles.forEach(function(toggle) {
                toggle.addEventListener('click', function() {
                    const parent = this.closest('.nav-parent');
                    const children = parent.querySelector('.nav-children');
                    const arrow = this.querySelector('.nav-arrow');

                    if (children.classList.contains('hidden')) {
                        children.classList.remove('hidden');
                        arrow.classList.add('rotate-90');
                    } else {
                        children.classList.add('hidden');
                        arrow.classList.remove('rotate-90');
                    }
                });
            });

            // Auto-expand parent if current page is a child item
            const activeChild = document.querySelector('.nav-children .nav-active');
            if (activeChild) {
                const parentContainer = activeChild.closest('.nav-parent');
                if (parentContainer) {
                    const children = parentContainer.querySelector('.nav-children');
                    const arrow = parentContainer.querySelector('.nav-arrow');
                    const toggle = parentContainer.querySelector('.nav-toggle');

                    children.classList.remove('hidden');
                    arrow.classList.add('rotate-90');
                    toggle.classList.add('nav-active-parent');
                }
            }

            // Close sidebar when clicking on a link (mobile)
            const sidebarLinks = sidebar.querySelectorAll('a');
            sidebarLinks.forEach(function(link) {
                link.addEventListener('click', function() {
                    if (window.innerWidth < 768) {
                        closeSidebarFunc();
                    }
                });
            });

            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 768) {
                    // Desktop view - ensure overlay is hidden and body overflow is reset
                    overlay.classList.add('hidden');
                    document.body.classList.remove('overflow-hidden');
                }
            });
        });
    </script>

    @stack('scripts')
</body>

</html>
