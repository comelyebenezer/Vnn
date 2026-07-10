@extends('layouts.frontend')

@section('title', 'Latest Gadgets')
@section('meta_description', 'VNN Latest Gadgets — Reviews, hands-on impressions, and news on the newest smartphones, laptops, wearables, and consumer tech.')

@section('content')
{{-- Hero --}}
<section class="relative bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 overflow-hidden">
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_right,_rgba(220,38,38,0.2)_0%,_transparent_60%)]"></div>
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_bottom_left,_rgba(4,44,96,0.2)_0%,_transparent_60%)]"></div>
    <div class="max-w-7xl mx-auto px-4 py-20 md:py-28 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <div class="flex items-center gap-3 mb-4">
                    <span class="w-10 h-[2px] bg-vnn-red"></span>
                    <span class="text-vnn-red text-xs font-bold uppercase tracking-[0.2em]">Verve News Network</span>
                </div>
                <h1 class="text-4xl md:text-6xl lg:text-7xl font-black text-white leading-tight font-heading">
                    Latest <span class="text-vnn-red">Gadgets</span>
                </h1>
                <p class="text-lg md:text-xl text-gray-300 mt-4 font-body leading-relaxed max-w-2xl">
                    Reviews, hands-on impressions, and breaking news on the newest smartphones, laptops, wearables, and consumer tech.
                </p>
                <div class="flex flex-wrap gap-4 mt-8">
                    <div class="bg-white/10 backdrop-blur rounded-lg px-5 py-3 text-center">
                        <div class="text-3xl font-black text-white font-heading">{{ $count }}</div>
                        <div class="text-xs text-gray-400 uppercase tracking-wider mt-1">Reviews</div>
                    </div>
                    <div class="bg-white/10 backdrop-blur rounded-lg px-5 py-3 text-center">
                        <div class="text-3xl font-black text-white font-heading">24/7</div>
                        <div class="text-xs text-gray-400 uppercase tracking-wider mt-1">Coverage</div>
                    </div>
                </div>
            </div>
            <div class="hidden lg:flex justify-center">
                <div class="relative w-72 h-72 md:w-80 md:h-80">
                    <div class="absolute inset-0 bg-gradient-to-br from-vnn-red/20 to-vnn-blue/20 rounded-full animate-pulse"></div>
                    <div class="absolute inset-4 bg-gradient-to-br from-slate-800 to-slate-900 rounded-full flex items-center justify-center border border-white/10">
                        <div class="text-center">
                            <div class="w-20 h-20 bg-vnn-red rounded-full flex items-center justify-center mx-auto mb-4 shadow-2xl shadow-vnn-red/30">
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                            </div>
                            <span class="text-white/60 text-xs uppercase tracking-widest">Gadget Reviews</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="absolute bottom-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-vnn-red/50 to-transparent"></div>
</section>

{{-- Articles Grid --}}
<section class="bg-white dark:bg-vnn-dark">
    <div class="max-w-7xl mx-auto px-4 py-16">
        <div class="flex items-center justify-between mb-10">
            <div>
                <span class="text-vnn-red text-xs font-bold uppercase tracking-[0.2em]">Fresh Reviews</span>
                <h2 class="text-3xl md:text-4xl font-black text-vnn-dark dark:text-white mt-2 font-heading">Gadget <span class="text-vnn-red">News</span></h2>
            </div>
        </div>

        @if($articles->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($articles as $item)
            <a href="{{ route('frontend.article', $item->slug) }}" class="group block bg-gray-50 dark:bg-vnn-dark-light rounded-2xl overflow-hidden hover:-translate-y-1 transition-all duration-300 hover:shadow-xl">
                <div class="aspect-video bg-vnn-dark overflow-hidden">
                    @if($item->featured_image)
                    <img src="{{ asset('storage/' . $item->featured_image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    @else
                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-vnn-red/20 to-vnn-dark">
                        <span class="text-white/10 font-extrabold text-4xl font-heading">G</span>
                    </div>
                    @endif
                </div>
                <div class="p-5">
                    <div class="flex items-center gap-2 text-[11px] text-gray-400 dark:text-gray-500 mb-2 font-body">
                        <span>{{ $item->publication_date?->format('M j, Y') ?? $item->created_at->format('M j, Y') }}</span>
                        <span>•</span>
                        <span>{{ $item->reading_time ?? '3' }} min read</span>
                    </div>
                    <h3 class="text-lg font-bold text-vnn-dark dark:text-white group-hover:text-vnn-red transition font-heading leading-snug">{{ $item->title }}</h3>
                    @if($item->excerpt)
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-2 line-clamp-2 font-body">{{ $item->excerpt }}</p>
                    @endif
                    <div class="flex items-center justify-between mt-4 pt-3 border-t border-gray-100 dark:border-gray-800">
                        @if($item->author)
                        <div class="flex items-center gap-2">
                            <div class="w-6 h-6 bg-vnn-red/20 rounded-full flex items-center justify-center">
                                <span class="text-[10px] font-bold text-vnn-red">{{ substr($item->author->name, 0, 1) }}</span>
                            </div>
                            <span class="text-xs text-gray-500 dark:text-gray-400 font-body">{{ $item->author->name }}</span>
                        </div>
                        @endif
                        <span class="text-xs font-bold text-vnn-red">Read More →</span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>

        <div class="mt-10">
            {{ $articles->links() }}
        </div>

        @else
        <div class="text-center py-20">
            <div class="w-20 h-20 bg-gradient-to-br from-vnn-red/20 to-vnn-blue/20 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-vnn-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
            </div>
            <h3 class="text-2xl font-black text-vnn-dark dark:text-white font-heading">Gadget Reviews Coming Soon</h3>
            <p class="text-gray-500 dark:text-gray-400 mt-3 max-w-md mx-auto font-body">Our tech team is preparing comprehensive reviews of the latest gadgets hitting the market.</p>
            <div class="flex items-center justify-center gap-2 mt-6 text-sm text-vnn-red font-bold">
                <span class="w-2 h-2 bg-vnn-red rounded-full animate-pulse"></span>
                <span>Under Review</span>
            </div>
        </div>
        @endif
    </div>
</section>

{{-- CTA --}}
<section class="bg-gradient-to-r from-slate-900 via-slate-800 to-slate-900 relative overflow-hidden">
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,_rgba(220,38,38,0.15)_0%,_transparent_70%)]"></div>
    <div class="max-w-7xl mx-auto px-4 py-16 text-center relative z-10">
        <h2 class="text-3xl md:text-4xl font-black text-white font-heading">Have a Gadget to Review?</h2>
        <p class="text-white/70 mt-3 max-w-xl mx-auto font-body">Want us to review your product? Reach out and we'll give it an honest, thorough review.</p>
        <div class="flex flex-wrap justify-center gap-4 mt-8">
            <a href="mailto:reviews@vervenewsnetwork.com" class="bg-vnn-red text-white font-bold px-8 py-3 rounded-xl hover:bg-vnn-red-dark transition shadow-lg active:scale-[0.98]">Submit for Review</a>
        </div>
    </div>
</section>
@endsection
