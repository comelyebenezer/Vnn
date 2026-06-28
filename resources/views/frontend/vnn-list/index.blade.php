@extends('layouts.frontend')

@section('title', 'VNN List')
@section('meta_description', 'VNN List — the definitive ranking of Nigeria\'s most valuable businesses and enterprises. Business profiling, rankings, and industry insights.')

@section('content')
{{-- Hero --}}
<section class="relative bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 overflow-hidden">
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_right,_rgba(220,38,38,0.15)_0%,_transparent_60%)]"></div>
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_bottom_left,_rgba(4,44,96,0.2)_0%,_transparent_60%)]"></div>
    <div class="max-w-7xl mx-auto px-4 py-20 md:py-28 relative z-10">
        <div class="max-w-3xl">
            <div class="flex items-center gap-3 mb-4">
                <span class="w-10 h-[2px] bg-vnn-red"></span>
                <span class="text-vnn-red text-xs font-bold uppercase tracking-[0.2em]">Verve News Network</span>
            </div>
            <h1 class="text-4xl md:text-6xl lg:text-7xl font-black text-white leading-tight font-heading">
                <span class="text-vnn-red">VNN</span> List
            </h1>
            <p class="text-lg md:text-xl text-gray-300 mt-4 font-body leading-relaxed max-w-2xl">
                The definitive ranking of Nigeria's most valuable businesses, enterprises, and industry leaders. A benchmark of excellence, innovation, and economic impact.
            </p>
            <div class="flex flex-wrap gap-4 mt-8">
                <div class="bg-white/10 backdrop-blur rounded-lg px-5 py-3 text-center">
                    <div class="text-3xl font-black text-white font-heading">{{ $count }}</div>
                    <div class="text-xs text-gray-400 uppercase tracking-wider mt-1">Listings</div>
                </div>
                <div class="bg-white/10 backdrop-blur rounded-lg px-5 py-3 text-center">
                    <div class="text-3xl font-black text-white font-heading">{{ $industries->count() ?: '12' }}</div>
                    <div class="text-xs text-gray-400 uppercase tracking-wider mt-1">Industries</div>
                </div>
                <div class="bg-white/10 backdrop-blur rounded-lg px-5 py-3 text-center">
                    <div class="text-3xl font-black text-white font-heading">₦</div>
                    <div class="text-xs text-gray-400 uppercase tracking-wider mt-1">Valuation</div>
                </div>
            </div>
        </div>
    </div>
    <div class="absolute bottom-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-vnn-red/50 to-transparent"></div>
</section>

{{-- About Section --}}
<section class="bg-white dark:bg-vnn-dark border-b border-gray-100 dark:border-gray-800">
    <div class="max-w-7xl mx-auto px-4 py-16 md:py-20">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <span class="text-vnn-red text-xs font-bold uppercase tracking-[0.2em]">About VNN List</span>
                <h2 class="text-3xl md:text-4xl font-black text-vnn-dark dark:text-white mt-3 font-heading">The Benchmark of <span class="text-vnn-red">Business Excellence</span></h2>
                <div class="w-16 h-1 bg-vnn-red mt-4"></div>
                <p class="text-gray-600 dark:text-gray-400 mt-6 font-body leading-relaxed">
                    VNN List is the premier business profiling and ranking platform by Verve News Network. We identify, evaluate, and celebrate the enterprises that drive Nigeria's economy forward.
                </p>
                <p class="text-gray-600 dark:text-gray-400 mt-4 font-body leading-relaxed">
                    Our rigorous evaluation process considers revenue, market influence, innovation, corporate governance, and social impact. Inclusion in VNN List is a mark of distinction — reserved for businesses that meet our exacting standards of excellence.
                </p>
                <div class="grid grid-cols-2 gap-4 mt-8">
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 bg-vnn-red/10 rounded-full flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-4 h-4 text-vnn-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-vnn-dark dark:text-white font-heading">Rigorous Selection</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5 font-body">Multi-factor evaluation process</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 bg-vnn-red/10 rounded-full flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-4 h-4 text-vnn-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-vnn-dark dark:text-white font-heading">Industry Impact</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5 font-body">Market influence & innovation scores</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 bg-vnn-red/10 rounded-full flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-4 h-4 text-vnn-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-vnn-dark dark:text-white font-heading">Valuation Metrics</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5 font-body">Revenue & growth analysis</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 bg-vnn-red/10 rounded-full flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-4 h-4 text-vnn-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-vnn-dark dark:text-white font-heading">Corporate Governance</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5 font-body">Ethics & compliance standards</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gradient-to-br from-slate-900 to-slate-800 rounded-2xl p-8 md:p-10 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-40 h-40 bg-vnn-red/10 rounded-full -translate-y-1/2 translate-x-1/2"></div>
                <div class="relative z-10">
                    <div class="flex items-center gap-2 mb-6">
                        <span class="w-2 h-2 bg-vnn-red rounded-full animate-pulse"></span>
                        <span class="text-gray-400 text-xs font-semibold uppercase tracking-wider">Featured Listing</span>
                    </div>
                    @if($featured)
                    <div class="text-white">
                        <div class="text-6xl font-black text-white/10 font-heading leading-none mb-2">01</div>
                        <h3 class="text-2xl font-black text-white font-heading">{{ $featured->title }}</h3>
                        <p class="text-gray-400 text-sm mt-3 font-body leading-relaxed">{{ $featured->excerpt }}</p>
                        <div class="flex items-center gap-3 mt-4 text-xs text-gray-500">
                            <span class="text-vnn-red font-bold">VNN Listed</span>
                            <span>•</span>
                            <span>{{ $featured->publication_date?->format('Y') ?? '2026' }}</span>
                        </div>
                    </div>
                    @else
                    <div class="text-center py-6">
                        <div class="w-16 h-16 bg-vnn-red/20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-vnn-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        </div>
                        <p class="text-white font-bold text-lg font-heading">Nominations Open</p>
                        <p class="text-gray-400 text-sm mt-1 font-body">Submit your enterprise for VNN List consideration</p>
                        <button class="mt-4 bg-vnn-red text-white text-sm font-bold px-6 py-2.5 rounded-lg hover:bg-vnn-red-dark transition">Apply for Listing</button>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Listings Grid --}}
<section class="bg-gray-50 dark:bg-vnn-dark-light">
    <div class="max-w-7xl mx-auto px-4 py-16">
        <div class="flex items-center justify-between mb-10">
            <div>
                <span class="text-vnn-red text-xs font-bold uppercase tracking-[0.2em]">The List</span>
                <h2 class="text-3xl md:text-4xl font-black text-vnn-dark dark:text-white mt-2 font-heading">VNN <span class="text-vnn-red">100</span></h2>
            </div>
            @if($industries->isNotEmpty())
            <div class="hidden md:flex items-center gap-2">
                <span class="text-xs text-gray-500 font-medium">Filter:</span>
                <select class="text-xs border border-gray-200 dark:border-gray-700 rounded px-3 py-2 bg-white dark:bg-vnn-dark dark:text-white focus:outline-none focus:border-vnn-red font-body">
                    <option value="">All Industries</option>
                    @foreach($industries as $ind)
                    <option value="{{ $ind }}">{{ $ind }}</option>
                    @endforeach
                </select>
            </div>
            @endif
        </div>

        @if($listings->count())
        <div class="space-y-4">
            @foreach($listings as $index => $listing)
            <a href="{{ route('frontend.article', $listing->slug) }}" class="group block bg-white dark:bg-vnn-dark rounded-xl hover:shadow-lg transition-all duration-300 border border-gray-100 dark:border-gray-800 hover:border-vnn-red/30 hover:-translate-y-0.5">
                <div class="flex items-center gap-5 p-5">
                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-vnn-red to-vnn-red-dark flex items-center justify-center shrink-0">
                        <span class="text-white font-black text-lg font-heading">{{ $loop->iteration + ($listings->currentPage() - 1) * $listings->perPage() }}</span>
                    </div>
                    <div class="w-16 h-16 bg-gray-100 dark:bg-vnn-dark-light rounded-lg overflow-hidden shrink-0 flex items-center justify-center">
                        @if($listing->featured_image)
                        <img src="{{ asset('storage/' . $listing->featured_image) }}" alt="{{ $listing->title }}" class="w-full h-full object-cover">
                        @else
                        <span class="text-gray-300 dark:text-gray-600 font-black text-2xl font-heading">{{ strtoupper(substr($listing->title, 0, 1)) }}</span>
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2">
                            <h3 class="text-lg font-bold text-vnn-dark dark:text-white group-hover:text-vnn-red transition font-heading">{{ $listing->title }}</h3>
                            <span class="text-[10px] bg-vnn-red/10 text-vnn-red font-bold px-2 py-0.5 rounded-full uppercase">VNN Listed</span>
                        </div>
                        @if($listing->excerpt)
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 line-clamp-1 font-body">{{ $listing->excerpt }}</p>
                        @endif
                        <div class="flex items-center gap-3 mt-2 text-xs text-gray-400">
                            <span class="flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                                Industry Leader
                            </span>
                            <span>•</span>
                            <span>{{ $listing->publication_date?->format('M Y') ?? '2026' }}</span>
                        </div>
                    </div>
                    <div class="hidden sm:flex items-center gap-2 text-vnn-red">
                        <span class="text-xs font-bold uppercase tracking-wider">View Profile</span>
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </div>
                </div>
            </a>
            @endforeach
        </div>

        <div class="mt-10">
            {{ $listings->links() }}
        </div>
        @else
        <div class="text-center py-20">
            <div class="w-20 h-20 bg-gradient-to-br from-vnn-red/20 to-vnn-blue/20 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-vnn-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
            </div>
            <h3 class="text-2xl font-black text-vnn-dark dark:text-white font-heading">Listings Coming Soon</h3>
            <p class="text-gray-500 dark:text-gray-400 mt-3 max-w-md mx-auto font-body">VNN List is currently being curated. Our team is evaluating Nigeria's top enterprises for inclusion.</p>
            <div class="flex items-center justify-center gap-2 mt-6 text-sm text-vnn-red font-bold">
                <span class="w-2 h-2 bg-vnn-red rounded-full animate-pulse"></span>
                <span>Nominations Open — Apply Now</span>
            </div>
        </div>
        @endif
    </div>
</section>

{{-- Criteria Section --}}
<section class="bg-white dark:bg-vnn-dark border-t border-gray-100 dark:border-gray-800">
    <div class="max-w-7xl mx-auto px-4 py-16">
        <div class="text-center mb-12">
            <span class="text-vnn-red text-xs font-bold uppercase tracking-[0.2em]">Selection Criteria</span>
            <h2 class="text-3xl md:text-4xl font-black text-vnn-dark dark:text-white mt-3 font-heading">What It Takes to Be <span class="text-vnn-red">Listed</span></h2>
            <p class="text-gray-500 dark:text-gray-400 mt-3 max-w-2xl mx-auto font-body">Our comprehensive evaluation framework ensures only the most deserving enterprises earn their place on the VNN List.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-gray-50 dark:bg-vnn-dark-light rounded-xl p-6 text-center group hover:shadow-md transition">
                <div class="w-14 h-14 bg-vnn-red/10 rounded-xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition">
                    <svg class="w-7 h-7 text-vnn-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h3 class="text-lg font-bold text-vnn-dark dark:text-white font-heading">Annual Revenue</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-2 font-body">Minimum revenue threshold of ₦500 million, verified through audited financial statements.</p>
            </div>
            <div class="bg-gray-50 dark:bg-vnn-dark-light rounded-xl p-6 text-center group hover:shadow-md transition">
                <div class="w-14 h-14 bg-vnn-red/10 rounded-xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition">
                    <svg class="w-7 h-7 text-vnn-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <h3 class="text-lg font-bold text-vnn-dark dark:text-white font-heading">Market Impact</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-2 font-body">Demonstrable influence on industry dynamics, market share, and competitive landscape.</p>
            </div>
            <div class="bg-gray-50 dark:bg-vnn-dark-light rounded-xl p-6 text-center group hover:shadow-md transition">
                <div class="w-14 h-14 bg-vnn-red/10 rounded-xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition">
                    <svg class="w-7 h-7 text-vnn-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
                <h3 class="text-lg font-bold text-vnn-dark dark:text-white font-heading">Corporate Governance</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-2 font-body">Strong ethical standards, regulatory compliance, and transparent business practices.</p>
            </div>
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="bg-gradient-to-r from-vnn-red to-vnn-red-dark">
    <div class="max-w-7xl mx-auto px-4 py-16 text-center">
        <h2 class="text-3xl md:text-4xl font-black text-white font-heading">Nominate Your Enterprise</h2>
        <p class="text-white/80 mt-3 max-w-xl mx-auto font-body">Join the ranks of Nigeria's most distinguished businesses. Submit your enterprise for VNN List evaluation.</p>
        <div class="flex flex-wrap justify-center gap-4 mt-8">
            <a href="#" class="bg-white text-vnn-red font-bold px-8 py-3 rounded-xl hover:bg-gray-100 transition shadow-lg active:scale-[0.98]">Submit Nomination</a>
            <a href="#" class="border-2 border-white text-white font-bold px-8 py-3 rounded-xl hover:bg-white/10 transition active:scale-[0.98]">Learn More</a>
        </div>
    </div>
</section>
@endsection
