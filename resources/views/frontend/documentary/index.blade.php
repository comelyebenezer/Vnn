@extends('layouts.frontend')

@section('title', 'Documentary')
@section('meta_description', 'VNN Documentary — In-depth documentary features, profiles, and investigative reports on government, business, entertainment, sports, and the people shaping Nigeria.')

@section('content')
{{-- Hero --}}
<section class="relative bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 overflow-hidden">
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_right,_rgba(220,38,38,0.15)_0%,_transparent_60%)]"></div>
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_bottom_left,_rgba(4,44,96,0.2)_0%,_transparent_60%)]"></div>
    <div class="absolute inset-0 opacity-5" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'0.3\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
    <div class="max-w-7xl mx-auto px-4 py-20 md:py-28 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <div class="flex items-center gap-3 mb-4">
                    <span class="w-10 h-[2px] bg-vnn-red"></span>
                    <span class="text-vnn-red text-xs font-bold uppercase tracking-[0.2em]">Verve News Network</span>
                </div>
                <h1 class="text-4xl md:text-6xl lg:text-7xl font-black text-white leading-tight font-heading">
                    VNN <span class="text-vnn-red">Documentary</span>
                </h1>
                <p class="text-lg md:text-xl text-gray-300 mt-4 font-body leading-relaxed max-w-2xl">
                    In-depth documentary features, exclusive profiles, and investigative reports on the people, institutions, and forces shaping Nigeria — from government corridors to entertainment stages.
                </p>
                <div class="flex flex-wrap gap-4 mt-8">
                    <div class="bg-white/10 backdrop-blur rounded-lg px-5 py-3 text-center">
                        <div class="text-3xl font-black text-white font-heading">{{ $count }}</div>
                        <div class="text-xs text-gray-400 uppercase tracking-wider mt-1">Documentaries</div>
                    </div>
                    <div class="bg-white/10 backdrop-blur rounded-lg px-5 py-3 text-center">
                        <div class="text-3xl font-black text-white font-heading">8+</div>
                        <div class="text-xs text-gray-400 uppercase tracking-wider mt-1">Categories</div>
                    </div>
                    <div class="bg-white/10 backdrop-blur rounded-lg px-5 py-3 text-center">
                        <div class="text-3xl font-black text-white font-heading">4K</div>
                        <div class="text-xs text-gray-400 uppercase tracking-wider mt-1">Production</div>
                    </div>
                </div>
            </div>
            <div class="hidden lg:flex justify-center">
                <div class="relative w-72 h-72 md:w-80 md:h-80">
                    <div class="absolute inset-0 bg-gradient-to-br from-vnn-red/20 to-vnn-blue/20 rounded-full animate-pulse"></div>
                    <div class="absolute inset-4 bg-gradient-to-br from-slate-800 to-slate-900 rounded-full flex items-center justify-center border border-white/10">
                        <div class="text-center">
                            <div class="w-20 h-20 bg-vnn-red rounded-full flex items-center justify-center mx-auto mb-4 shadow-2xl shadow-vnn-red/30">
                                <svg class="w-10 h-10 text-white ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                            </div>
                            <span class="text-white/60 text-xs uppercase tracking-widest">Watch Documentaries</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="absolute bottom-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-vnn-red/50 to-transparent"></div>
</section>

{{-- Documentary Grid Wrapper --}}
<div x-data="{ activeFilter: 'all' }">
{{-- Categories Filter --}}
<section class="bg-white dark:bg-vnn-dark border-b border-gray-100 dark:border-gray-800 sticky top-[120px] z-20">
    <div class="max-w-7xl mx-auto px-4 py-4">
        <div class="flex items-center gap-2 overflow-x-auto scrollbar-hide">
            <button @click="activeFilter = 'all'" class="shrink-0 px-4 py-2 text-xs font-bold uppercase tracking-wider rounded-full border transition font-heading" :class="activeFilter === 'all' ? 'bg-vnn-red text-white border-vnn-red' : 'text-gray-500 dark:text-gray-400 border-gray-200 dark:border-gray-700 hover:border-vnn-red hover:text-vnn-red'">All</button>
            @foreach($tags as $tag)
            <button @click="activeFilter = '{{ $tag->slug }}'" class="shrink-0 px-4 py-2 text-xs font-bold uppercase tracking-wider rounded-full border transition font-heading" :class="activeFilter === '{{ $tag->slug }}' ? 'bg-vnn-red text-white border-vnn-red' : 'text-gray-500 dark:text-gray-400 border-gray-200 dark:border-gray-700 hover:border-vnn-red hover:text-vnn-red'">{{ $tag->name }}</button>
            @endforeach
        </div>
    </div>
</section>

{{-- Featured Documentary --}}
@if($featured)
<section class="bg-gray-50 dark:bg-vnn-dark-light">
    <div class="max-w-7xl mx-auto px-4 py-16">
        <div class="flex items-center gap-3 mb-8">
            <span class="w-2 h-2 bg-vnn-red rounded-full animate-pulse"></span>
            <span class="text-vnn-red text-xs font-bold uppercase tracking-[0.2em]">Featured Documentary</span>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">
            <div class="lg:col-span-3">
                <div class="doc-player relative aspect-video bg-vnn-dark rounded-2xl overflow-hidden" data-youtube-id="{{ $featured->youtube_id }}">
                    {{-- Poster --}}
                    <div class="doc-poster absolute inset-0 cursor-pointer group">
                        @if($featured->featured_image)
                        <img src="{{ asset('storage/' . $featured->featured_image) }}" alt="{{ $featured->title }}" class="w-full h-full object-cover">
                        @elseif($featured->youtube_id)
                        <img src="https://img.youtube.com/vi/{{ $featured->youtube_id }}/maxresdefault.jpg" alt="{{ $featured->title }}" class="w-full h-full object-cover">
                        @else
                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-vnn-red/60 to-vnn-dark">
                            <span class="text-white/10 font-extrabold text-6xl font-heading">D</span>
                        </div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
                        @if($featured->youtube_id)
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="w-16 h-16 md:w-20 md:h-20 bg-vnn-red/90 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-2xl shadow-vnn-red/30">
                                <svg class="w-7 h-7 md:w-9 md:h-9 text-white ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                            </div>
                        </div>
                        @endif
                    </div>
                    {{-- Iframe (hidden initially) --}}
                    @if($featured->youtube_id)
                    <div class="doc-iframe" style="display:none; position:absolute; inset:0;">
                        <iframe src="" data-src="https://www.youtube.com/embed/{{ $featured->youtube_id }}?autoplay=1&rel=0&modestbranding=1" class="w-full h-full" frameborder="0" allow="autoplay; encrypted-media; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    @endif
                </div>
            </div>
            <div class="lg:col-span-2 flex flex-col justify-center">
                <span class="text-vnn-red text-xs font-bold uppercase tracking-wider">Documentary</span>
                <h2 class="text-2xl md:text-3xl font-black text-vnn-dark dark:text-white mt-2 font-heading">{{ $featured->title }}</h2>
                @if($featured->excerpt)
                <p class="text-gray-600 dark:text-gray-400 mt-3 font-body leading-relaxed">{{ $featured->excerpt }}</p>
                @endif
                <div class="flex items-center gap-4 mt-4 text-sm text-gray-500 dark:text-gray-400 font-body">
                    @if($featured->author)
                    <span>Directed by {{ $featured->author->name }}</span>
                    <span>•</span>
                    @endif
                    <span>{{ $featured->publication_date?->format('F j, Y') ?? $featured->created_at->format('F j, Y') }}</span>
                </div>
                <a href="{{ route('frontend.article', $featured->slug) }}" class="inline-flex items-center gap-2 mt-6 text-vnn-red font-bold text-sm group">
                    <span>Read More</span>
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
        </div>
    </div>
</section>
@endif

{{-- Documentary Grid --}}
<section class="bg-white dark:bg-vnn-dark">
    <div class="max-w-7xl mx-auto px-4 py-16">
        <div class="flex items-center justify-between mb-10">
            <div>
                <span class="text-vnn-red text-xs font-bold uppercase tracking-[0.2em]">Latest Releases</span>
                <h2 class="text-3xl md:text-4xl font-black text-vnn-dark dark:text-white mt-2 font-heading">Documentary <span class="text-vnn-red">Films</span></h2>
            </div>
        </div>

        @if($documentaries->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($documentaries as $doc)
            @php $docTags = $doc->tags->pluck('slug')->implode(','); @endphp
            <div x-show="activeFilter === 'all' || '{{ $docTags }}'.includes(activeFilter)" class="group block bg-gray-50 dark:bg-vnn-dark-light rounded-2xl overflow-hidden hover:-translate-y-1 transition-all duration-300 hover:shadow-xl">
                <div class="doc-player relative aspect-video bg-vnn-dark overflow-hidden" data-youtube-id="{{ $doc->youtube_id }}">
                    {{-- Poster --}}
                    <div class="doc-poster absolute inset-0 cursor-pointer">
                        @if($doc->featured_image)
                        <img src="{{ asset('storage/' . $doc->featured_image) }}" alt="{{ $doc->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        @elseif($doc->youtube_id)
                        <img src="https://img.youtube.com/vi/{{ $doc->youtube_id }}/maxresdefault.jpg" alt="{{ $doc->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        @else
                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-slate-800 to-slate-900">
                            <span class="text-white/10 font-extrabold text-4xl font-heading">D</span>
                        </div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                        @if($doc->youtube_id)
                        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="w-14 h-14 bg-vnn-red/90 rounded-full flex items-center justify-center shadow-xl shadow-vnn-red/20">
                                <svg class="w-6 h-6 text-white ml-0.5" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                            </div>
                        </div>
                        @endif
                        <div class="absolute top-3 left-3">
                            <span class="bg-vnn-red text-white text-[10px] font-bold px-2 py-0.5 rounded uppercase tracking-wide">Documentary</span>
                        </div>
                    </div>
                    {{-- Iframe (hidden initially) --}}
                    @if($doc->youtube_id)
                    <div class="doc-iframe" style="display:none; position:absolute; inset:0;">
                        <iframe src="" data-src="https://www.youtube.com/embed/{{ $doc->youtube_id }}?autoplay=1&rel=0&modestbranding=1" class="w-full h-full" frameborder="0" allow="autoplay; encrypted-media; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    @endif
                </div>
                <div class="p-5">
                    <div class="flex items-center gap-2 text-[11px] text-gray-400 dark:text-gray-500 mb-2 font-body">
                        <span>{{ $doc->publication_date?->format('M j, Y') ?? $doc->created_at->format('M j, Y') }}</span>
                        <span>•</span>
                        <span>{{ $doc->reading_time ?? '45' }} min</span>
                    </div>
                    <h3 class="text-lg font-bold text-vnn-dark dark:text-white group-hover:text-vnn-red transition font-heading leading-snug">{{ $doc->title }}</h3>
                    @if($doc->excerpt)
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-2 line-clamp-2 font-body">{{ $doc->excerpt }}</p>
                    @endif
                    <div class="flex items-center justify-between mt-4 pt-3 border-t border-gray-100 dark:border-gray-800">
                        @if($doc->author)
                        <div class="flex items-center gap-2">
                            <div class="w-6 h-6 bg-vnn-red/20 rounded-full flex items-center justify-center">
                                <span class="text-[10px] font-bold text-vnn-red">{{ substr($doc->author->name, 0, 1) }}</span>
                            </div>
                            <span class="text-xs text-gray-500 dark:text-gray-400 font-body">{{ $doc->author->name }}</span>
                        </div>
                        @endif
                        <a href="{{ route('frontend.article', $doc->slug) }}" class="text-xs font-bold text-vnn-red hover:underline">Read More →</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        @else
        <div class="text-center py-20">
            <div class="w-20 h-20 bg-gradient-to-br from-vnn-red/20 to-vnn-blue/20 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-vnn-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
            </div>
            <h3 class="text-2xl font-black text-vnn-dark dark:text-white font-heading">Documentaries Coming Soon</h3>
            <p class="text-gray-500 dark:text-gray-400 mt-3 max-w-md mx-auto font-body">Our documentary team is currently in production. We're capturing compelling stories from across Nigeria.</p>
            <div class="flex items-center justify-center gap-2 mt-6 text-sm text-vnn-red font-bold">
                <span class="w-2 h-2 bg-vnn-red rounded-full animate-pulse"></span>
                <span>In Production</span>
            </div>
        </div>
        @endif
    </div>
</section>
</div>

{{-- Categories Section --}}
<section class="bg-gray-50 dark:bg-vnn-dark-light border-t border-gray-100 dark:border-gray-800">
    <div class="max-w-7xl mx-auto px-4 py-16">
        <div class="text-center mb-12">
            <span class="text-vnn-red text-xs font-bold uppercase tracking-[0.2em]">Explore</span>
            <h2 class="text-3xl md:text-4xl font-black text-vnn-dark dark:text-white mt-3 font-heading">Documentary <span class="text-vnn-red">Categories</span></h2>
            <p class="text-gray-500 dark:text-gray-400 mt-3 max-w-2xl mx-auto font-body">In-depth coverage across the sectors that define Nigeria's past, present, and future.</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            <a href="{{ route('frontend.category', 'politics') }}" class="group bg-white dark:bg-vnn-dark rounded-xl p-6 hover:-translate-y-1 transition-all duration-300 border border-gray-100 dark:border-gray-800 hover:border-vnn-red/30 hover:shadow-lg">
                <div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-blue-800 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                </div>
                <h3 class="text-lg font-bold text-vnn-dark dark:text-white font-heading">Government & Politics</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-2 font-body">Profiles of governors, ministers, and the inner workings of Nigeria's political system.</p>
            </a>
            <a href="{{ route('frontend.category', 'business') }}" class="group bg-white dark:bg-vnn-dark rounded-xl p-6 hover:-translate-y-1 transition-all duration-300 border border-gray-100 dark:border-gray-800 hover:border-vnn-red/30 hover:shadow-lg">
                <div class="w-12 h-12 bg-gradient-to-br from-amber-600 to-amber-800 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h3 class="text-lg font-bold text-vnn-dark dark:text-white font-heading">Business & Enterprise</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-2 font-body">Entrepreneur journeys, corporate titans, and the businessmen shaping Nigeria's economy.</p>
            </a>
            <a href="{{ route('frontend.category', 'entertainment') }}" class="group bg-white dark:bg-vnn-dark rounded-xl p-6 hover:-translate-y-1 transition-all duration-300 border border-gray-100 dark:border-gray-800 hover:border-vnn-red/30 hover:shadow-lg">
                <div class="w-12 h-12 bg-gradient-to-br from-purple-600 to-purple-800 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                </div>
                <h3 class="text-lg font-bold text-vnn-dark dark:text-white font-heading">Entertainment & Celebrities</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-2 font-body">Behind the scenes with Nollywood stars, musicians, and Nigeria's cultural icons.</p>
            </a>
            <a href="{{ route('frontend.category', 'sports') }}" class="group bg-white dark:bg-vnn-dark rounded-xl p-6 hover:-translate-y-1 transition-all duration-300 border border-gray-100 dark:border-gray-800 hover:border-vnn-red/30 hover:shadow-lg">
                <div class="w-12 h-12 bg-gradient-to-br from-green-600 to-green-800 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h3 class="text-lg font-bold text-vnn-dark dark:text-white font-heading">Sports Legends</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-2 font-body">Profiles of athletes, coaches, and the personalities driving Nigerian sports.</p>
            </a>
            <a href="{{ route('frontend.category', 'culture') }}" class="group bg-white dark:bg-vnn-dark rounded-xl p-6 hover:-translate-y-1 transition-all duration-300 border border-gray-100 dark:border-gray-800 hover:border-vnn-red/30 hover:shadow-lg">
                <div class="w-12 h-12 bg-gradient-to-br from-orange-600 to-orange-800 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h3 class="text-lg font-bold text-vnn-dark dark:text-white font-heading">Culture & Heritage</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-2 font-body">Exploring Nigeria's rich cultural tapestry, traditions, and the custodians of heritage.</p>
            </a>
            <a href="{{ route('frontend.category', 'investigations') }}" class="group bg-white dark:bg-vnn-dark rounded-xl p-6 hover:-translate-y-1 transition-all duration-300 border border-gray-100 dark:border-gray-800 hover:border-vnn-red/30 hover:shadow-lg">
                <div class="w-12 h-12 bg-gradient-to-br from-red-700 to-red-900 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <h3 class="text-lg font-bold text-vnn-dark dark:text-white font-heading">Investigative Reports</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-2 font-body">Deep-dive investigations uncovering the truths that matter for Nigeria's development.</p>
            </a>
        </div>
    </div>
</section>

{{-- Production Values --}}
<section class="bg-white dark:bg-vnn-dark">
    <div class="max-w-7xl mx-auto px-4 py-16">
        <div class="text-center mb-12">
            <span class="text-vnn-red text-xs font-bold uppercase tracking-[0.2em]">Our Standard</span>
            <h2 class="text-3xl md:text-4xl font-black text-vnn-dark dark:text-white mt-3 font-heading">Cinematic <span class="text-vnn-red">Documentary</span> Production</h2>
            <p class="text-gray-500 dark:text-gray-400 mt-3 max-w-2xl mx-auto font-body">Every VNN documentary is produced to the highest broadcast standards, combining journalistic integrity with cinematic storytelling.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="text-center p-6">
                <div class="w-16 h-16 bg-gradient-to-br from-vnn-red/20 to-vnn-blue/20 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-vnn-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                </div>
                <h4 class="text-sm font-bold text-vnn-dark dark:text-white font-heading">4K Production</h4>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 font-body">Ultra-high definition cinematography</p>
            </div>
            <div class="text-center p-6">
                <div class="w-16 h-16 bg-gradient-to-br from-vnn-red/20 to-vnn-blue/20 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-vnn-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"/></svg>
                </div>
                <h4 class="text-sm font-bold text-vnn-dark dark:text-white font-heading">Professional Narration</h4>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 font-body">Expert voice-over and commentary</p>
            </div>
            <div class="text-center p-6">
                <div class="w-16 h-16 bg-gradient-to-br from-vnn-red/20 to-vnn-blue/20 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-vnn-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                </div>
                <h4 class="text-sm font-bold text-vnn-dark dark:text-white font-heading">Original Scoring</h4>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 font-body">Custom-composed soundtracks</p>
            </div>
            <div class="text-center p-6">
                <div class="w-16 h-16 bg-gradient-to-br from-vnn-red/20 to-vnn-blue/20 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-vnn-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/></svg>
                </div>
                <h4 class="text-sm font-bold text-vnn-dark dark:text-white font-heading">In-Depth Research</h4>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 font-body">Rigorous fact-checking and sourcing</p>
            </div>
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="bg-gradient-to-r from-slate-900 via-slate-800 to-slate-900 relative overflow-hidden">
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,_rgba(220,38,38,0.1)_0%,_transparent_70%)]"></div>
    <div class="max-w-7xl mx-auto px-4 py-16 text-center relative z-10">
        <h2 class="text-3xl md:text-4xl font-black text-white font-heading">Have a Story Worth Telling?</h2>
        <p class="text-white/70 mt-3 max-w-xl mx-auto font-body">VNN Documentary is always seeking compelling stories about the people and institutions shaping Nigeria. Submit your story idea for consideration.</p>
        <div class="flex flex-wrap justify-center gap-4 mt-8">
            <a href="#" class="bg-vnn-red text-white font-bold px-8 py-3 rounded-xl hover:bg-vnn-red-dark transition shadow-lg active:scale-[0.98]">Submit a Story</a>
            <a href="#" class="border-2 border-white/30 text-white font-bold px-8 py-3 rounded-xl hover:bg-white/10 transition active:scale-[0.98]">Contact Our Team</a>
        </div>
    </div>
</section>

@push('styles')
<style>
    .doc-player { position: relative; }
    .doc-player .doc-iframe { position: absolute; inset: 0; }
    .doc-player .doc-iframe iframe { width: 100%; height: 100%; border: 0; }
</style>
@endpush

@push('scripts')
<script>
(function() {
    document.querySelectorAll('.doc-player').forEach(function(player) {
        var poster = player.querySelector('.doc-poster');
        var iframeWrap = player.querySelector('.doc-iframe');
        if (!poster || !iframeWrap) return;

        poster.style.cursor = 'pointer';

        poster.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            var iframe = iframeWrap.querySelector('iframe');
            if (iframe && iframe.dataset.src) {
                iframe.src = iframe.dataset.src;
            }
            poster.style.display = 'none';
            iframeWrap.style.display = 'block';
        });
    });
})();
</script>
@endpush
@endsection
