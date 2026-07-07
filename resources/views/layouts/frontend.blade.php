<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{
    mobileOpen: false,
    searchOpen: false,
    showEpapers: false,
    darkMode: localStorage.getItem('darkMode') === 'true',
    searchQuery: '',
    searchResults: [],
    searching: false,

    toggleDark() {
        this.darkMode = !this.darkMode;
        localStorage.setItem('darkMode', this.darkMode);
        document.documentElement.classList.toggle('dark', this.darkMode);
    },

    async doSearch() {
        if (this.searchQuery.length < 2) { this.searchResults = []; return; }
        this.searching = true;
        try {
            const res = await fetch(`/api/search?q=${encodeURIComponent(this.searchQuery)}`);
            this.searchResults = await res.json();
        } catch { this.searchResults = []; }
        this.searching = false;
    }
}" x-init="document.documentElement.classList.toggle('dark', darkMode)">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name')) | {{ config('app.shortname') }}</title>
    <meta name="description" content="@yield('meta_description', config('app.tagline'))">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', config('app.name'))">
    <meta property="og:description" content="@yield('meta_description', config('app.tagline'))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', config('app.name'))">
    <meta name="twitter:description" content="@yield('meta_description', config('app.tagline'))">
    @stack('meta')

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:300,400,500,600,700,800,900&display=swap" rel="stylesheet" />
    <link href="https://fonts.bunny.net/css?family=merriweather:300,400,700,900&display=swap" rel="stylesheet" />
    <link rel="alternate" type="application/rss+xml" title="{{ config('app.name') }}" href="{{ route('rss') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @stack('styles')
</head>
<body class="font-heading antialiased bg-vnn-gray dark:bg-vnn-dark overflow-x-hidden" :class="{ 'overflow-hidden': mobileOpen }">

    {{-- Sticky Header --}}
    <div class="sticky top-0 z-50">
    {{-- Top Bar --}}
    <div class="bg-vnn-dark text-white text-[11px] py-2 border-b border-vnn-red/30">
        <div class="max-w-7xl mx-auto px-4 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <span class="hidden sm:inline text-gray-400">{{ now()->format('l, F j, Y') }}</span>
                <span class="hidden sm:inline text-gray-600">|</span>
                <span class="text-gray-400">{{ now()->format('H:i T') }}</span>
            </div>
            <div class="flex items-center gap-1 sm:gap-2">
                <a href="#" class="w-8 h-8 p-1.5 sm:w-7 sm:h-7 sm:p-0 flex items-center justify-center text-gray-400 hover:text-vnn-red transition rounded-full hover:bg-white/10"><svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg></a>
                <a href="#" class="hidden sm:flex w-8 h-8 p-1.5 sm:w-7 sm:h-7 sm:p-0 items-center justify-center text-gray-400 hover:text-vnn-red transition rounded-full hover:bg-white/10"><svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg></a>
                <a href="#" class="hidden md:flex w-8 h-8 p-1.5 sm:w-7 sm:h-7 sm:p-0 items-center justify-center text-gray-400 hover:text-vnn-red transition rounded-full hover:bg-white/10"><svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg></a>
                <a href="#" class="hidden lg:flex w-8 h-8 p-1.5 sm:w-7 sm:h-7 sm:p-0 items-center justify-center text-gray-400 hover:text-vnn-red transition rounded-full hover:bg-white/10"><svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.477 2 2 6.477 2 12v0c0 5.523 4.477 10 10 10s10-4.477 10-10-4.477-10-10-10zm3.5 14.5H14v-2.5c0-.828-.672-1.5-1.5-1.5s-1.5.672-1.5 1.5v2.5H8.5v-8h2.5v1.5c.5-.5 1.2-1 2.5-1 1.933 0 3.5 1.567 3.5 3.5v4zM7.5 8.5c-.828 0-1.5-.672-1.5-1.5s.672-1.5 1.5-1.5S9 6.172 9 7s-.672 1.5-1.5 1.5z"/></svg></a>
                <a href="#" class="hidden lg:flex w-8 h-8 p-1.5 sm:w-7 sm:h-7 sm:p-0 items-center justify-center text-gray-400 hover:text-vnn-red transition rounded-full hover:bg-white/10"><svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm5.562 8.248c-.237.3-.527.558-.855.753-.03.296-.044.599-.082.897-.46 3.624-1.94 6.143-5.26 7.957-2.246 1.229-4.613 1.38-7.086.384.987.079 1.945-.174 2.79-.672 1.434-.827 2.447-1.93 3.005-3.493.311-.882.088-1.653-.608-2.22-.573-.468-1.185-.684-1.897-.506-.808.202-1.303.716-1.502 1.513-.201.809-.047 1.557.425 2.236.12.173.132.2-.057.072-1.937-2.066-1.87-4.784.201-6.904 1.04-1.064 2.337-1.639 3.914-1.715.899-.043 1.686.202 2.271.899.491.586.539 1.29.376 2.005-.159.7-.585 1.221-1.235 1.55-.342.173-.397.04-.087-.141.385-.225.596-.569.643-1.008.013-.255-.026-.332-.285-.383-.586-.117-1.151-.097-1.54.364-.382.453-.52.988-.492 1.567.042.89.437 1.505 1.213 1.867.429.2.891.305 1.36.338.886.062 1.639-.24 2.143-.995.317-.475.45-1.016.381-1.59-.049-.407-.196-.778-.435-1.092-1.17-1.53-3.478-1.71-4.964-.427-1.45 1.252-1.772 3.188-.61 4.893.425.623.981 1.09 1.672 1.383 1.09.462 2.221.25 3.112-.597.53-.503.877-1.118 1.048-1.844.144-.615.017-1.211-.35-1.736-.28-.4-.344-.439-.054-.195.526.443.79 1.012.747 1.703-.061.988-.465 1.837-1.153 2.531-1.04 1.05-2.341 1.534-3.842 1.471-1.235-.052-2.335-.44-3.237-1.256-1.23-1.114-1.843-2.506-1.808-4.148.036-1.664.643-3.093 1.831-4.258 1.306-1.28 2.903-1.848 4.714-1.72 1.469.104 2.734.672 3.763 1.72.157.16.308.325.382.533.059.165.017.227-.17.113z"/></svg></a>
                <span class="text-gray-600 mx-1">|</span>
                <button @click="toggleDark()" class="flex items-center gap-1.5 px-2.5 py-1.5 rounded-full text-gray-400 hover:text-white hover:bg-white/10 transition border border-gray-600 hover:border-gray-400 focus:outline-none" aria-label="Toggle dark mode" :class="{ 'bg-white/10 border-gray-400': darkMode }">
                    <svg x-show="!darkMode" class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                    <svg x-show="darkMode" class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    <span class="text-[10px] font-semibold uppercase tracking-wider" x-text="darkMode ? 'Light' : 'Dark'"></span>
                </button>
                <a href="#" @click.prevent="showEpapers = true" class="hidden md:inline text-gray-400 hover:text-vnn-red transition ml-1 text-[10px] uppercase font-semibold">e-Paper</a>
            </div>
        </div>
    </div>

    {{-- Header / Logo --}}
    <header class="bg-white dark:bg-vnn-dark-light border-b border-gray-200 dark:border-vnn-dark-light">
        <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
            <div class="flex items-center gap-2 sm:gap-4 min-w-0">
                <button @click="mobileOpen = !mobileOpen" class="lg:hidden p-2.5 text-gray-600 dark:text-gray-300 hover:text-vnn-red focus:outline-none shrink-0" aria-label="Toggle menu">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!mobileOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path x-show="mobileOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
                <button @click="searchOpen = !searchOpen; if(!searchOpen) { searchQuery = ''; searchResults = []; }" class="lg:hidden p-2.5 text-gray-600 dark:text-gray-300 hover:text-vnn-red focus:outline-none shrink-0" aria-label="Toggle search">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </button>
                <a href="{{ url('/') }}" class="flex items-center gap-2 sm:gap-3 shrink-0 min-w-0">
                    @php $siteLogo = \App\Models\Setting::where('key', 'site_logo')->value('value'); @endphp
                    @if($siteLogo)
                    <img src="{{ asset('storage/' . $siteLogo) }}" alt="{{ config('app.name') }}" class="h-8 sm:h-10 w-auto shrink-0">
                    <span class="font-extrabold text-sm sm:text-lg md:text-xl lg:text-2xl tracking-tight font-heading uppercase truncate"><span class="text-vnn-red dark:text-white">VERVE NEWS </span><span class="hidden sm:inline" style="color:#042c60">NETWORK</span></span>
                    @else
                    <div class="w-8 h-8 sm:w-10 sm:h-10 bg-vnn-red rounded flex items-center justify-center shadow shrink-0">
                        <span class="text-white font-extrabold text-lg sm:text-xl">V</span>
                    </div>
                    <div class="min-w-0">
                        <div class="text-vnn-red dark:text-white font-extrabold text-sm sm:text-lg md:text-xl lg:text-2xl tracking-tight leading-none font-heading uppercase truncate">VERVE NEWS</div>
                        <div class="text-gray-500 dark:text-gray-400 font-medium text-[9px] sm:text-[10px] tracking-[0.15em] uppercase">Network</div>
                    </div>
                    @endif
                </a>
            </div>

            <div class="hidden lg:flex items-center gap-3">
                <button @click="searchOpen = !searchOpen; if(!searchOpen) { searchQuery = ''; searchResults = []; }" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-600 dark:text-gray-300 border border-gray-200 dark:border-gray-600 rounded hover:border-vnn-red hover:text-vnn-red transition" aria-label="Toggle search">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <span>Search</span>
                </button>
                @auth
                    <a href="{{ route('dashboard') }}" class="bg-vnn-red text-white text-sm font-semibold px-5 py-2 rounded hover:bg-vnn-red-dark transition">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-semibold text-vnn-red hover:text-vnn-red-dark transition px-3">Sign In</a>
                    <a href="{{ route('register') }}" class="bg-vnn-red text-white text-sm font-semibold px-5 py-2 rounded hover:bg-vnn-red-dark transition">Subscribe</a>
                @endauth
            </div>
        </div>

        {{-- Search Overlay --}}
        <div x-show="searchOpen" x-cloak @click.away="searchOpen = false; searchQuery = ''; searchResults = []" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="border-t border-gray-200 dark:border-gray-700 bg-white dark:bg-vnn-dark-light">
            <div class="max-w-7xl mx-auto px-4 py-4">
                <div class="relative max-w-2xl mx-auto">
                    <input
                        type="text"
                        x-model="searchQuery"
                        @input.debounce.300ms="doSearch()"
                        @keydown.escape="searchOpen = false; searchQuery = ''; searchResults = []"
                        placeholder="Search news, topics..."
                        class="w-full border border-gray-300 dark:border-gray-600 rounded px-4 py-3 pr-12 text-sm bg-white dark:bg-vnn-dark dark:text-white focus:outline-none focus:border-vnn-red focus:ring-1 focus:ring-vnn-red font-body"
                    >
                    <svg x-show="searching" class="absolute right-4 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg>
                    <svg x-show="!searching && searchQuery.length > 0" @click="searchQuery = ''; searchResults = []" class="absolute right-4 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 hover:text-gray-600 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>

                    <div x-show="searchResults.length > 0" x-cloak class="absolute top-full left-0 right-0 mt-1 bg-white dark:bg-vnn-dark-light border border-gray-200 dark:border-gray-700 rounded shadow-xl max-h-80 overflow-y-auto z-50">
                        <template x-for="r in searchResults" :key="r.id">
                            <a :href="'/article/' + r.slug" class="flex items-center gap-3 px-4 py-3 hover:bg-vnn-gray dark:hover:bg-vnn-dark border-b border-gray-100 dark:border-gray-700 last:border-0 group">
                                <img x-show="r.featured_image" :src="'/storage/' + r.featured_image" class="w-10 h-10 rounded object-cover shrink-0">
                                <div x-show="!r.featured_image" class="w-10 h-10 rounded bg-vnn-red/10 flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5 text-vnn-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-gray-800 dark:text-gray-100 truncate group-hover:text-vnn-red" x-text="r.title"></p>
                                    <p class="text-xs text-gray-400 font-body" x-text="r.excerpt?.substring(0, 80) + (r.excerpt?.length > 80 ? '...' : '')"></p>
                                </div>
                            </a>
                        </template>
                    </div>

                    <p x-show="searchQuery.length >= 2 && !searching && searchResults.length === 0" x-cloak class="absolute top-full left-0 right-0 mt-1 bg-white dark:bg-vnn-dark-light border border-gray-200 dark:border-gray-700 rounded shadow-xl p-4 text-sm text-gray-400 text-center z-50">No results found for "<span x-text="searchQuery"></span>"</p>
                </div>
            </div>
        </div>
    </header>

    {{-- Primary Navigation --}}
    <nav class="bg-black border-b-2 border-vnn-red hidden lg:block">
        <div class="max-w-7xl mx-auto px-4 flex items-center">
            <a href="{{ url('/') }}" class="px-2 py-3 text-xs font-semibold {{ request()->is('/') ? 'bg-vnn-red text-white' : 'text-white hover:bg-white/10' }} transition whitespace-nowrap uppercase">Home</a>
            @php
                $navItems = [
                    ['name' => 'News', 'slug' => 'news'],
                    ['name' => 'Politics', 'slug' => 'politics'],
                    ['name' => 'Business', 'slug' => 'business'],
                    ['name' => 'Technology', 'slug' => 'technology'],
                    ['name' => 'Sport', 'slug' => 'sports'],
                    ['name' => 'Entertainment', 'slug' => 'entertainment'],
                    ['name' => 'World', 'slug' => 'world'],
                    ['name' => 'Africa', 'slug' => 'africa'],
                    ['name' => 'Opinion', 'slug' => 'opinion'],
                    ['name' => 'Editorial', 'slug' => 'editorial'],
                    ['name' => 'VNN List', 'slug' => 'vnn-list', 'route' => 'frontend.vnn-list'],
                    ['name' => 'Documentary', 'slug' => 'documentary', 'route' => 'frontend.documentary'],
                ];
            @endphp
            @foreach($navItems as $item)
                <a href="{{ isset($item['route']) ? route($item['route']) : route('frontend.category', $item['slug']) }}"
                   class="px-2 py-3 text-xs font-medium text-white hover:bg-white/10 transition whitespace-nowrap uppercase">
                    {{ $item['name'] }}
                </a>
            @endforeach
            <div class="ml-auto flex items-center gap-2">
                <a href="#live-updates" class="flex items-center gap-1 px-2 py-1 bg-vnn-red/90 hover:bg-vnn-red text-white text-[10px] font-bold rounded transition uppercase tracking-wide">
                    <span class="w-1.5 h-1.5 bg-white rounded-full animate-pulse"></span>
                    Live
                </a>
                <div class="relative group">
                <a href="#" class="px-2 py-3 text-xs font-medium text-white hover:bg-white/10 transition uppercase flex items-center gap-1">More <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg></a>
                <div class="absolute right-0 top-full bg-white dark:bg-vnn-dark-light shadow-lg border border-gray-200 dark:border-gray-700 rounded-b min-w-48 hidden group-hover:block z-50">
                    <a href="{{ route('frontend.podcast') }}" class="block px-4 py-2.5 text-sm text-gray-700 dark:text-gray-200 hover:bg-vnn-blue hover:text-white transition">Podcast</a>
                    <a href="{{ route('frontend.video') }}" class="block px-4 py-2.5 text-sm text-gray-700 dark:text-gray-200 hover:bg-vnn-blue hover:text-white transition">Video</a>
                    <a href="#" class="block px-4 py-2.5 text-sm text-gray-700 dark:text-gray-200 hover:bg-vnn-red hover:text-white transition">Gallery</a>
                    <a href="{{ route('frontend.category', 'health') }}" class="block px-4 py-2.5 text-sm text-gray-700 dark:text-gray-200 hover:bg-vnn-red hover:text-white transition">Health</a>
                    <a href="{{ route('frontend.category', 'education') }}" class="block px-4 py-2.5 text-sm text-gray-700 dark:text-gray-200 hover:bg-vnn-red hover:text-white transition">Education</a>
                </div>
            </div>
        </div>
    </nav>
    </div>

    {{-- Mobile Navigation --}}
    <div x-show="mobileOpen" x-cloak @click.away="mobileOpen = false" class="fixed inset-0 z-50 lg:hidden">
        <div class="fixed inset-0 bg-black/60" @click="mobileOpen = false"></div>
        <div class="fixed top-0 left-0 bottom-0 w-72 max-w-[85vw] bg-white dark:bg-vnn-dark shadow-2xl overflow-y-auto">
            <div class="p-4 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between bg-vnn-dark">
                <a href="{{ url('/') }}" class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-vnn-red rounded flex items-center justify-center">
                        <span class="text-white font-extrabold">V</span>
                    </div>
                    <span class="font-extrabold text-white text-lg uppercase">VNN</span>
                </a>
                <button @click="mobileOpen = false" class="p-2 text-gray-400 hover:text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <div class="p-4 space-y-1">
                <a href="{{ url('/') }}" class="block px-4 py-3.5 text-sm md:text-base font-semibold rounded {{ request()->is('/') ? 'bg-vnn-red text-white' : 'text-gray-700 dark:text-gray-200 hover:bg-vnn-gray dark:hover:bg-vnn-dark-light' }}">Home</a>
                @foreach($navItems as $item)
                    <a href="{{ isset($item['route']) ? route($item['route']) : route('frontend.category', $item['slug']) }}" class="block px-4 py-3.5 text-sm md:text-base font-medium text-gray-700 dark:text-gray-200 hover:bg-vnn-gray dark:hover:bg-vnn-dark-light rounded">{{ $item['name'] }}</a>
                @endforeach
            </div>
            <div class="px-4 pb-4 pt-2 border-t border-gray-100 dark:border-gray-700 mt-2">
                <p class="text-xs text-gray-400 uppercase tracking-wider font-semibold mb-2">More</p>
                <a href="#live-updates" class="flex items-center gap-2 px-4 py-3 text-sm md:text-base text-vnn-red font-bold rounded">
                    <span class="w-2 h-2 bg-vnn-red rounded-full animate-pulse"></span>
                    Live Updates
                </a>
                <a href="{{ route('frontend.podcast') }}" class="block px-4 py-3 text-sm md:text-base text-gray-600 dark:text-gray-300 hover:bg-vnn-blue hover:text-white rounded">Podcast</a>
                <a href="{{ route('frontend.video') }}" class="block px-4 py-3 text-sm md:text-base text-gray-600 dark:text-gray-300 hover:bg-vnn-blue hover:text-white rounded">Video</a>
                <a href="#" class="block px-4 py-3 text-sm md:text-base text-gray-600 dark:text-gray-300 hover:bg-vnn-red hover:text-white rounded">Gallery</a>
                <a href="{{ route('frontend.category', 'health') }}" class="block px-4 py-3 text-sm md:text-base text-gray-600 dark:text-gray-300 hover:bg-vnn-red hover:text-white rounded">Health</a>
                <a href="{{ route('frontend.category', 'education') }}" class="block px-4 py-3 text-sm md:text-base text-gray-600 dark:text-gray-300 hover:bg-vnn-red hover:text-white rounded">Education</a>
                <a href="#subscribe" class="block px-4 py-3 text-sm md:text-base text-gray-600 dark:text-gray-300 hover:bg-vnn-red hover:text-white rounded">Newsletter</a>
            </div>
            <div class="px-4 pb-6">
                @auth
                    <a href="{{ route('dashboard') }}" class="block w-full text-center bg-vnn-red text-white text-sm font-bold py-3 rounded hover:bg-vnn-red-dark transition">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="block w-full text-center bg-vnn-red text-white text-sm font-bold py-3 rounded hover:bg-vnn-red-dark transition">Sign In</a>
                    <a href="{{ route('register') }}" class="block w-full text-center border-2 border-vnn-red text-vnn-red text-sm font-bold py-3 rounded hover:bg-vnn-red hover:text-white transition mt-2">Subscribe</a>
                @endauth
            </div>
        </div>
    </div>

    {{-- News Ticker --}}
    @php $tickerItems = \App\Models\TickerItem::where('is_active', true)->orderBy('sort_order')->get(); @endphp
    @if($tickerItems->count())
    <div class="bg-vnn-dark border-b border-vnn-red/30 overflow-hidden">
        <div class="max-w-7xl mx-auto flex">
            <div class="overflow-hidden relative flex-1">
                <div class="flex whitespace-nowrap animate-marquee py-2">
                    @foreach($tickerItems->merge($tickerItems) as $item)
                    <span class="text-white/90 text-xs font-body mx-4">{{ $item->icon }} {{ $item->text }}</span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-vnn-dark text-white mt-12 border-t-4 border-vnn-red">
        <div class="max-w-7xl mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center gap-3 mb-4">
                    @php $siteLogo = \App\Models\Setting::where('key', 'site_logo')->value('value'); @endphp
                    @if($siteLogo)
                    <img src="{{ asset('storage/' . $siteLogo) }}" alt="{{ config('app.name') }}" class="h-8 sm:h-10 w-auto brightness-0 invert shrink-0">
                    <span class="font-extrabold text-lg sm:text-xl tracking-tight font-heading uppercase truncate"><span class="text-white">VERVE NEWS </span><span class="hidden sm:inline" style="color:#60a5fa">NETWORK</span></span>
                    @else
                    <div class="w-10 h-10 bg-vnn-red rounded flex items-center justify-center">
                        <span class="text-white font-extrabold text-xl">V</span>
                    </div>
                    <div>
                        <div class="text-white font-extrabold text-xl leading-none uppercase">Verve News</div>
                        <div class="text-red-300 font-medium text-xs tracking-[0.15em] uppercase">Network</div>
                    </div>
                    @endif
                    </div>
                    <p class="text-gray-300 text-sm leading-relaxed font-body">Verve News Network brings you the latest headlines, opinions, political news, business reports and international news from Nigeria and around the world.</p>
                </div>
                <div>
                    <h4 class="font-bold text-sm uppercase tracking-wider mb-4 text-vnn-red">Sections</h4>
                    <ul class="space-y-2 text-sm text-gray-300">
                        <li><a href="{{ url('/') }}" class="hover:text-white transition">Home</a></li>
                        @foreach(['news', 'politics', 'business', 'technology', 'sports', 'entertainment', 'world', 'africa'] as $slug)
                            <li><a href="{{ route('frontend.category', $slug) }}" class="hover:text-white transition">{{ ucfirst($slug) }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-sm uppercase tracking-wider mb-4 text-vnn-red">More</h4>
                    <ul class="space-y-2 text-sm text-gray-300">
                        <li><a href="{{ route('frontend.category', 'opinion') }}" class="hover:text-white transition">Opinion</a></li>
                        <li><a href="{{ route('frontend.category', 'editorial') }}" class="hover:text-white transition">Editorial</a></li>
                        <li><a href="{{ route('frontend.video') }}" class="text-blue-300 hover:text-white transition">Video</a></li>
                        <li><a href="{{ route('frontend.podcast') }}" class="text-blue-300 hover:text-white transition">Podcast</a></li>
                        <li><a href="#" class="hover:text-white transition">Gallery</a></li>
                        <li><a href="#subscribe" class="hover:text-white transition">Newsletter</a></li>
                        <li><a href="{{ route('rss') }}" class="hover:text-white transition">RSS Feed</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-sm uppercase tracking-wider mb-4 text-vnn-red">Follow Us</h4>
                    <div class="flex gap-3 mb-6">
                        <a href="#" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-vnn-red transition"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg></a>
                        <a href="#" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-vnn-red transition"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg></a>
                        <a href="#" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-vnn-red transition"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg></a>
                        <a href="#" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-vnn-red transition"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.477 2 2 6.477 2 12v0c0 5.523 4.477 10 10 10s10-4.477 10-10-4.477-10-10-10zm3.5 14.5H14v-2.5c0-.828-.672-1.5-1.5-1.5s-1.5.672-1.5 1.5v2.5H8.5v-8h2.5v1.5c.5-.5 1.2-1 2.5-1 1.933 0 3.5 1.567 3.5 3.5v4zM7.5 8.5c-.828 0-1.5-.672-1.5-1.5s.672-1.5 1.5-1.5S9 6.172 9 7s-.672 1.5-1.5 1.5z"/></svg></a>
                        <a href="#" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-vnn-red transition"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm5.562 8.248c-.237.3-.527.558-.855.753-.03.296-.044.599-.082.897-.46 3.624-1.94 6.143-5.26 7.957-2.246 1.229-4.613 1.38-7.086.384.987.079 1.945-.174 2.79-.672 1.434-.827 2.447-1.93 3.005-3.493.311-.882.088-1.653-.608-2.22-.573-.468-1.185-.684-1.897-.506-.808.202-1.303.716-1.502 1.513-.201.809-.047 1.557.425 2.236.12.173.132.2-.057.072-1.937-2.066-1.87-4.784.201-6.904 1.04-1.064 2.337-1.639 3.914-1.715.899-.043 1.686.202 2.271.899.491.586.539 1.29.376 2.005-.159.7-.585 1.221-1.235 1.55-.342.173-.397.04-.087-.141.385-.225.596-.569.643-1.008.013-.255-.026-.332-.285-.383-.586-.117-1.151-.097-1.54.364-.382.453-.52.988-.492 1.567.042.89.437 1.505 1.213 1.867.429.2.891.305 1.36.338.886.062 1.639-.24 2.143-.995.317-.475.45-1.016.381-1.59-.049-.407-.196-.778-.435-1.092-1.17-1.53-3.478-1.71-4.964-.427-1.45 1.252-1.772 3.188-.61 4.893.425.623.981 1.09 1.672 1.383 1.09.462 2.221.25 3.112-.597.53-.503.877-1.118 1.048-1.844.144-.615.017-1.211-.35-1.736-.28-.4-.344-.439-.054-.195.526.443.79 1.012.747 1.703-.061.988-.465 1.837-1.153 2.531-1.04 1.05-2.341 1.534-3.842 1.471-1.235-.052-2.335-.44-3.237-1.256-1.23-1.114-1.843-2.506-1.808-4.148.036-1.664.643-3.093 1.831-4.258 1.306-1.28 2.903-1.848 4.714-1.72 1.469.104 2.734.672 3.763 1.72.157.16.308.325.382.533.059.165.017.227-.17.113z"/></svg></a>
                    </div>
                    <div id="subscribe">
                    <h4 class="font-bold text-sm uppercase tracking-wider mb-3 text-vnn-red">Newsletter</h4>
                    <p class="text-xs text-gray-300 mb-2 font-body">Get the latest news delivered to your inbox</p>
                    @livewire('newsletter-subscribe', ['layout' => 'horizontal'], key('footer-subscribe'))
                </div>
                </div>
            </div>
            <div class="border-t border-vnn-red/30 mt-8 pt-6 text-center text-xs text-gray-400">
                <p>&copy; {{ date('Y') }} Verve News Network. All rights reserved. | <a href="#" class="hover:text-white transition">Privacy Policy</a> | <a href="#" class="hover:text-white transition">Terms of Service</a> | <a href="#" class="hover:text-white transition">Advertise With Us</a></p>
            </div>
        </div>
    </footer>

    {{-- e-Paper Coming Soon Modal --}}
    <div x-show="showEpapers" x-cloak class="fixed inset-0 z-[60] flex items-center justify-center p-4" @keydown.escape.window="showEpapers = false">
        <div class="fixed inset-0 bg-black/70" @click="showEpapers = false"></div>
        <div class="relative bg-white dark:bg-vnn-dark-light rounded-2xl shadow-2xl max-w-md w-full p-8 text-center" @click.away="showEpapers = false">
            <button @click="showEpapers = false" class="absolute top-3 right-3 w-8 h-8 flex items-center justify-center text-gray-400 hover:text-gray-600 dark:hover:text-white rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
            <div class="w-20 h-20 bg-gradient-to-br from-vnn-red to-vnn-red-dark rounded-full flex items-center justify-center mx-auto mb-5 shadow-lg">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
            </div>
            <h3 class="text-2xl font-extrabold text-vnn-dark dark:text-white font-heading">Coming Soon</h3>
            <p class="text-gray-500 dark:text-gray-400 text-sm mt-3 font-body leading-relaxed">Our e-Paper edition is currently in development. Stay tuned for digital access to Verve News Network's print edition, coming to your screen very soon.</p>
            <div class="mt-6 flex items-center justify-center gap-2 text-xs text-gray-400 font-body">
                <span class="w-2 h-2 bg-vnn-red rounded-full animate-pulse"></span>
                <span>Notify me when launched</span>
            </div>
            <button @click="showEpapers = false" class="mt-6 w-full bg-vnn-red text-white font-bold py-3 px-6 rounded-xl hover:bg-vnn-red-dark transition active:scale-[0.98]">Got it</button>
        </div>
    </div>

    @livewireScripts
    @stack('scripts')
</body>
</html>