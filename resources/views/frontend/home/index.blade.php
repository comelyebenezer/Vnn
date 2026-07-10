@extends('layouts.frontend')

@section('title', 'Homepage')

@section('content')
{{-- Hero Section --}}
<section class="max-w-7xl mx-auto px-4 py-3">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-4">
        {{-- Breaking News --}}
        <div class="lg:col-span-5 lg:flex lg:flex-col">
            <div class="border-b border-vnn-red pb-1.5 mb-2">
                <h2 class="text-sm font-extrabold text-vnn-dark dark:text-white uppercase tracking-tight font-heading">Breaking News</h2>
            </div>
            {{-- Featured breaking story --}}
            @php $story = $breakingArticles->isNotEmpty() ? $breakingArticles->first() : $featured; @endphp
            @if($story)
            <a href="{{ route('frontend.article', $story->slug) }}" class="group block relative mb-2 shrink-0">
                <div class="aspect-[16/9] bg-vnn-dark rounded overflow-hidden">
                    @if($story->featured_image)
                    <img src="{{ asset('storage/' . $story->featured_image) }}" alt="{{ $story->title }}" class="w-full h-full object-cover">
                    @else
                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-vnn-red/80 to-vnn-dark">
                        <span class="text-white/10 font-extrabold text-5xl font-heading">V</span>
                    </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/30 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-4">
                        @if($story->is_breaking)
                        <span class="bg-vnn-red text-white text-[10px] font-bold px-1.5 py-0.5 rounded uppercase tracking-wide">Breaking News</span>
                        @endif
                        <h2 class="text-white text-sm font-extrabold mt-1.5 leading-snug group-hover:underline transition-all duration-200 font-heading">{{ $story->title }}</h2>
                        <p class="text-gray-300 text-[11px] mt-1 line-clamp-1 font-body">{{ $story->excerpt }}</p>
                        <div class="flex items-center gap-2 mt-1.5 text-[10px] text-gray-400">
                            <span>Published by <span class="font-bold text-vnn-red">VNN</span></span>
                            <span>•</span>
                            <span>{{ $story->publication_date?->diffForHumans() ?? $story->created_at->diffForHumans() }}</span>
                            @if($story->category)
                            <span>•</span>
                            <span class="text-vnn-red font-semibold">{{ $story->category->name }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </a>
            @else
            <a href="#" class="group block relative mb-2 shrink-0">
                <div class="aspect-[16/9] bg-vnn-dark rounded overflow-hidden">
                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-vnn-red/80 to-vnn-dark">
                        <span class="text-white/10 font-extrabold text-5xl font-heading">V</span>
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/30 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-4">
                        <span class="bg-vnn-red text-white text-[10px] font-bold px-1.5 py-0.5 rounded uppercase tracking-wide">Breaking News</span>
                        <h2 class="text-white text-sm font-extrabold mt-1.5 leading-snug group-hover:underline transition-all duration-200 font-heading">President Announces Major Economic Reforms to Stabilize Currency and Boost Foreign Investment</h2>
                        <p class="text-gray-300 text-[11px] mt-1 line-clamp-1 font-body">In a nationwide address, the President outlined sweeping economic measures including tax reforms, foreign exchange liberalization, and infrastructure spending aimed at restoring investor confidence.</p>
                        <div class="flex items-center gap-2 mt-1.5 text-[10px] text-gray-400">
                            <span>By Chidi Okonkwo</span>
                            <span>•</span>
                            <span>15 mins ago</span>
                            <span>•</span>
                            <span class="text-vnn-red font-semibold">Politics</span>
                        </div>
                    </div>
                </div>
            </a>
            @endif
            {{-- More breaking news list --}}
            <div class="divide-y divide-gray-100 dark:divide-gray-800 shrink-0">
                @forelse($breakingNews as $bn)
                <div class="flex items-start gap-2 py-2 pr-1">
                    <span class="w-1.5 h-1.5 bg-vnn-red rounded-full mt-1.5 shrink-0 animate-pulse"></span>
                    <div>
                        <h4 class="text-xs font-bold leading-snug text-vnn-dark dark:text-white font-heading">{{ $bn->title }}</h4>
                        <span class="text-[10px] text-gray-400 dark:text-gray-500 font-body">{{ $bn->created_at->diffForHumans() }}</span>
                    </div>
                </div>
                @empty
                @if(!$story)
                <p class="text-gray-400 dark:text-gray-500 text-xs font-body py-3 text-center">No breaking news at the moment.</p>
                @endif
                @endforelse
            </div>

            {{-- Trending Videos --}}
            @if($trendingVideos->isNotEmpty())
            <div class="mt-4 pt-3 border-t border-vnn-red/30 shrink-0">
                <div class="flex items-center justify-between mb-2">
                    <h2 class="text-sm font-extrabold text-vnn-dark dark:text-white uppercase tracking-tight font-heading flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 text-vnn-red" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M9.383 3.076A1 1 0 0110 4v12a1 1 0 01-1.707.707L4.586 13H2a1 1 0 01-1-1V8a1 1 0 011-1h2.586l3.707-3.707a1 1 0 011.09-.217zM14.657 2.929a1 1 0 011.414 0A9.972 9.972 0 0119 10a9.972 9.972 0 01-2.929 7.071 1 1 0 01-1.414-1.414A7.971 7.971 0 0017 10c0-2.21-.894-4.208-2.343-5.657a1 1 0 010-1.414zm-2.829 2.828a1 1 0 011.415 0A5.983 5.983 0 0115 10a5.984 5.984 0 01-1.757 4.243 1 1 0 01-1.415-1.415A3.984 3.984 0 0013 10a3.983 3.983 0 00-1.172-2.828 1 1 0 010-1.415z" clip-rule="evenodd"/></svg>
                        Top Videos
                    </h2>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    @foreach($trendingVideos->take(2) as $tv)
                    <div x-data="{ playing: false }" class="group bg-vnn-dark rounded-lg overflow-hidden">
                        {{-- Thumbnail / Player --}}
                        <div class="aspect-video bg-black overflow-hidden relative">
                            {{-- Player --}}
                            <template x-if="playing">
                                @if($tv->youtube_id)
                                <iframe src="https://www.youtube.com/embed/{{ $tv->youtube_id }}?autoplay=1&rel=0" class="absolute inset-0 w-full h-full" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                @elseif($tv->video_file)
                                <video src="{{ asset('storage/' . $tv->video_file) }}" controls autoplay class="absolute inset-0 w-full h-full object-cover bg-black"></video>
                                @elseif($tv->embed_code)
                                <div class="absolute inset-0 w-full h-full">{!! $tv->embed_code !!}</div>
                                @endif
                            </template>
                            {{-- Thumbnail --}}
                            <template x-if="!playing">
                                <div class="absolute inset-0" @click="
                                    @if($tv->youtube_id || $tv->video_file || $tv->embed_code)
                                        playing = true
                                    @endif
                                ">
                                    @if($tv->thumbnail)
                                    <img src="{{ str_starts_with($tv->thumbnail, 'http') ? $tv->thumbnail : asset('storage/' . $tv->thumbnail) }}" alt="{{ $tv->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                    @else
                                    <div class="w-full h-full bg-gradient-to-br from-vnn-red to-vnn-red-dark flex items-center justify-center">
                                        <span class="text-white/15 font-extrabold text-4xl">V</span>
                                    </div>
                                    @endif
                                    @if($tv->youtube_id || $tv->video_file || $tv->embed_code)
                                    <div class="absolute inset-0 flex items-center justify-center cursor-pointer">
                                        <div class="w-12 h-12 bg-vnn-red/90 rounded-full flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                                            <svg class="w-6 h-6 text-white ml-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"/></svg>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </template>
                        </div>
                        <div class="p-2.5 flex items-start justify-between">
                            <div class="min-w-0 flex-1">
                                <h4 class="text-white text-[11px] font-bold leading-snug group-hover:text-vnn-red transition line-clamp-2">{{ $tv->title }}</h4>
                                @if($tv->duration)
                                <span class="text-[10px] text-gray-400 mt-1 inline-block">{{ gmdate('i:s', $tv->duration) }}</span>
                                @endif
                            </div>
                            @if($tv->youtube_id || $tv->video_file || $tv->embed_code)
                            <button @click="playing = !playing" class="shrink-0 ml-2 text-gray-400 hover:text-white transition" :title="playing ? 'Close' : 'Play'">
                                <svg x-show="!playing" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <svg x-show="playing" x-cloak class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Ad Banner --}}
            @if(isset($advertisements['banner']) && $advertisements['banner']->isNotEmpty())
                @php $ad = $advertisements['banner']->random(); @endphp
                <div class="mt-4 lg:flex-1">
                    @if($ad->script_code)
                        {!! $ad->script_code !!}
                    @elseif($ad->media_file)
                        <a href="{{ $ad->link ?? '#' }}" target="_blank" rel="noopener" class="block overflow-hidden rounded-lg border border-gray-200 dark:border-gray-700">
                            @if($ad->media_type === 'video')
                            <div class="relative w-full" style="padding-top: 25%;">
                                <video src="{{ asset('storage/' . $ad->media_file) }}" class="absolute inset-0 w-full h-full object-cover" muted playsinline onmouseenter="this.play()" onmouseleave="this.pause();this.currentTime=0;"></video>
                            </div>
                            @else
                            <img src="{{ asset('storage/' . $ad->media_file) }}" alt="{{ $ad->title }}" class="w-full h-40 object-cover">
                            @endif
                        </a>
                    @elseif($ad->image_url)
                        <a href="{{ $ad->link ?? '#' }}" target="_blank" rel="noopener" class="block overflow-hidden rounded-lg border border-gray-200 dark:border-gray-700">
                            <img src="{{ $ad->image_url }}" alt="{{ $ad->title }}" class="w-full h-40 object-cover">
                        </a>
                    @else
                        <div class="bg-vnn-gray dark:bg-vnn-dark-light border border-gray-200 dark:border-gray-700 rounded flex items-center justify-center text-gray-400 dark:text-gray-500 text-xs h-40">{{ $ad->title }}</div>
                    @endif
                </div>
            @else
            <div class="bg-vnn-gray dark:bg-vnn-dark-light border border-gray-200 dark:border-gray-700 rounded flex items-center justify-center text-gray-400 dark:text-gray-500 text-xs mt-4 lg:flex-1">Advertisement</div>
            @endif
        </div>

        {{-- Live Updates --}}
        <div id="live-updates" class="lg:col-span-4">
            <div class="border-b border-vnn-blue pb-1.5 mb-2">
                <h2 class="text-sm font-extrabold text-vnn-dark dark:text-white uppercase tracking-tight font-heading flex items-center gap-1.5">
                    <span class="w-1.5 h-1.5 bg-red-500 rounded-full animate-pulse"></span>
                    Live Updates
                </h2>
            </div>
            @if($liveUpdates->count())
            <div class="space-y-2">
                @foreach($liveUpdates as $live)
                <a href="{{ route('frontend.live', $live->id) }}" class="block bg-vnn-dark rounded overflow-hidden border-l-4 border-vnn-blue hover:border-vnn-red transition">
                    @if($live->media_type === 'image' && $live->image_file)
                    <div class="aspect-video bg-black relative">
                        <img src="{{ asset('storage/' . $live->image_file) }}" alt="{{ $live->title }}" class="w-full h-full object-cover">
                        @if($live->is_live)
                        <span class="absolute top-1 left-1 flex items-center gap-1 bg-vnn-red text-white text-[8px] font-bold px-1 py-0.5 rounded uppercase tracking-wide">
                            <span class="w-1 h-1 bg-white rounded-full animate-pulse"></span>
                            Live
                        </span>
                        @endif
                    </div>
                    @elseif($live->video_url || $live->video_file)
                    <div class="aspect-video bg-black relative">
                        @if($live->video_type === 'youtube')
                        <iframe src="{{ $live->embed_url }}" class="w-full h-full" frameborder="0" allowfullscreen allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"></iframe>
                        @elseif($live->video_type === 'facebook')
                        <iframe src="{{ $live->embed_url }}" class="w-full h-full" frameborder="0" allowfullscreen></iframe>
                        @elseif($live->video_file)
                        <video class="w-full h-full" controls preload="metadata" playsinline>
                            <source src="{{ asset('storage/' . $live->video_file) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                        @endif
                        @if($live->is_live)
                        <span class="absolute top-1 left-1 flex items-center gap-1 bg-vnn-red text-white text-[8px] font-bold px-1 py-0.5 rounded uppercase tracking-wide">
                            <span class="w-1 h-1 bg-white rounded-full animate-pulse"></span>
                            Live
                        </span>
                        @endif
                    </div>
                    @endif
                    <div class="p-2.5">
                        <h4 class="text-white text-xs font-bold leading-snug">{{ $live->title }}</h4>
                        @if($live->description)
                        <p class="text-gray-400 dark:text-gray-500 text-[11px] mt-1 line-clamp-2 font-body">{{ $live->description }}</p>
                        @endif
                    </div>
                </a>
                @endforeach
            </div>
            @else
            <div class="bg-vnn-dark rounded p-3 text-center border-l-4 border-vnn-blue">
                <div class="w-10 h-10 bg-vnn-blue/20 rounded-full flex items-center justify-center mx-auto mb-1.5">
                    <svg class="w-5 h-5 text-vnn-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                </div>
                <p class="text-gray-400 dark:text-gray-500 text-xs font-body">No live streams right now</p>
            </div>
            @endif
        </div>

        {{-- Trending --}}
        <div class="lg:col-span-3">
            <div class="border-b border-vnn-red pb-1.5 mb-2">
                <h2 class="text-sm font-extrabold text-vnn-dark dark:text-white uppercase tracking-tight font-heading">Trending</h2>
            </div>
            @php
                $trendingItems = $trendingArticles->isNotEmpty() ? $trendingArticles : $topNews;
            @endphp
            <div class="space-y-3">
                @forelse($trendingItems as $i => $news)
                <a href="{{ route('frontend.article', $news->slug) }}" class="flex gap-3 group {{ !$loop->last ? 'pb-3 border-b border-gray-100 dark:border-gray-800' : '' }}">
                    @if($news->featured_image)
                    <div class="w-20 sm:w-32 h-16 sm:h-24 rounded overflow-hidden shrink-0">
                        <img src="{{ asset('storage/' . $news->featured_image) }}" alt="{{ $news->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                    </div>
                    @else
                    <div class="w-20 sm:w-32 h-16 sm:h-24 bg-gradient-to-br from-vnn-dark to-slate-800 rounded overflow-hidden shrink-0 flex items-center justify-center">
                        <span class="text-white/15 font-extrabold text-2xl">V</span>
                    </div>
                    @endif
                    <div class="flex-1 min-w-0">
                        @if($news->category)
                        <span class="text-vnn-red text-[10px] font-bold uppercase tracking-wide">{{ $news->category->name }}</span>
                        @endif
                        <h3 class="text-sm font-bold leading-snug mt-0.5 text-gray-900 dark:text-white group-hover:text-vnn-red transition line-clamp-2 font-heading">{{ $news->title }}</h3>
                    </div>
                </a>
                @empty
                @for ($i = 0; $i < 5; $i++)
                <a href="#" class="flex gap-3 group {{ $i < 4 ? 'pb-3 border-b border-gray-100 dark:border-gray-800' : '' }}">
                    <div class="w-20 sm:w-32 h-16 sm:h-24 bg-gradient-to-br from-vnn-dark to-slate-800 rounded overflow-hidden shrink-0 flex items-center justify-center">
                        <span class="text-white/15 font-extrabold text-2xl">V</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <span class="text-vnn-red text-[10px] font-bold uppercase tracking-wide">{{ ['Politics', 'News', 'Entertainment', 'Education', 'Sports'][$i] }}</span>
                        <h3 class="text-sm font-bold leading-snug mt-0.5 text-gray-900 dark:text-white group-hover:text-vnn-red transition line-clamp-2 font-heading">Trending headline {{ $i + 1 }} that is making waves right now</h3>
                    </div>
                </a>
                @endfor
                @endforelse
            </div>
        </div>
    </div>
</section>

{{-- Ad Banner --}}
<section class="max-w-7xl mx-auto px-4 py-3">
    @if(isset($advertisements['banner']) && $advertisements['banner']->count() > 1)
        @php $ad = $advertisements['banner']->except($advertisements['banner']->keys()->first())->random(); @endphp
        @if($ad->script_code)
            {!! $ad->script_code !!}
        @elseif($ad->media_file)
            <a href="{{ $ad->link ?? '#' }}" target="_blank" rel="noopener" class="block overflow-hidden rounded-lg border border-gray-200 dark:border-gray-700">
                @if($ad->media_type === 'video')
                <div class="relative w-full" style="padding-top: 25%;">
                    <video src="{{ asset('storage/' . $ad->media_file) }}" class="absolute inset-0 w-full h-full object-cover" muted playsinline onmouseenter="this.play()" onmouseleave="this.pause();this.currentTime=0;"></video>
                </div>
                @else
                <img src="{{ asset('storage/' . $ad->media_file) }}" alt="{{ $ad->title }}" class="w-full h-40 object-cover">
                @endif
            </a>
        @elseif($ad->image_url)
            <a href="{{ $ad->link ?? '#' }}" target="_blank" rel="noopener" class="block overflow-hidden rounded-lg border border-gray-200 dark:border-gray-700">
                <img src="{{ $ad->image_url }}" alt="{{ $ad->title }}" class="w-full h-40 object-cover">
            </a>
        @else
            <div class="bg-vnn-gray dark:bg-vnn-dark-light border border-gray-200 dark:border-gray-700 rounded h-40 flex items-center justify-center text-gray-400 dark:text-gray-500 text-sm">{{ $ad->title }}</div>
        @endif
    @else
    <div class="bg-vnn-gray dark:bg-vnn-dark-light border border-gray-200 dark:border-gray-700 rounded h-24 flex items-center justify-center text-gray-400 dark:text-gray-500 text-sm">Advertisement</div>
    @endif
</section>

{{-- Main Content + Sidebar --}}
<section class="max-w-7xl mx-auto px-4 py-4">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        {{-- Main Column --}}
        <div class="lg:col-span-7 space-y-6">

            @php
                $sectionOrder = ['news', 'politics', 'business', 'technology', 'sports', 'entertainment', 'world'];
            @endphp

            @foreach($sectionOrder as $slug)
                @php $sec = $categoryArticles[$slug] ?? null; @endphp
                @if($sec && $sec['main'])
                <div>
                    <div class="flex items-center gap-3 mb-5 border-b-2 border-vnn-red pb-2">
                        <h2 class="text-lg font-extrabold text-vnn-dark dark:text-white uppercase tracking-tight font-heading">{{ $sec['category']->name }}</h2>
                        <div class="flex-1"></div>
                        <a href="{{ route('frontend.category', $slug) }}" class="text-xs text-vnn-red font-semibold hover:underline">See All →</a>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <a href="{{ route('frontend.article', $sec['main']->slug) }}" class="group md:col-span-2">
                            @if($sec['main']->featured_image)
                            <div class="aspect-[16/9] rounded overflow-hidden mb-3">
                                <img src="{{ asset('storage/' . $sec['main']->featured_image) }}" alt="{{ $sec['main']->title }}" class="w-full h-full object-cover">
                            </div>
                            @else
                            <div class="aspect-[16/9] bg-gradient-to-br from-vnn-red/60 to-vnn-dark rounded overflow-hidden flex items-center justify-center mb-3">
                                <span class="text-white/15 font-extrabold text-4xl">{{ substr($sec['category']->name, 0, 1) }}</span>
                            </div>
                            @endif
                            <span class="text-vnn-red text-xs font-bold uppercase tracking-wide">{{ $sec['category']->name }}</span>
                            <h3 class="text-lg font-bold leading-snug mt-1 text-gray-900 dark:text-white group-hover:text-vnn-red transition font-heading">{{ $sec['main']->title }}</h3>
                            @if($sec['main']->excerpt)
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 line-clamp-2 font-body">{{ $sec['main']->excerpt }}</p>
                            @endif
                        </a>
                        @forelse($sec['subs'] as $sub)
                        <a href="{{ route('frontend.article', $sub->slug) }}" class="group flex gap-3">
                            @if($sub->featured_image)
                            <div class="w-16 sm:w-20 h-12 sm:h-16 rounded overflow-hidden shrink-0">
                                <img src="{{ asset('storage/' . $sub->featured_image) }}" alt="{{ $sub->title }}" class="w-full h-full object-cover">
                            </div>
                            @else
                            <div class="w-16 sm:w-20 h-12 sm:h-16 bg-gradient-to-br from-vnn-dark to-slate-800 rounded overflow-hidden shrink-0 flex items-center justify-center">
                                <span class="text-white/15 font-extrabold">{{ substr($sec['category']->name, 0, 1) }}</span>
                            </div>
                            @endif
                            <div>
                                <h4 class="text-sm font-bold leading-snug text-gray-900 dark:text-white group-hover:text-vnn-red transition line-clamp-2 font-heading">{{ $sub->title }}</h4>
                                <span class="text-xs text-gray-400 dark:text-gray-500">{{ $sub->publication_date?->diffForHumans() ?? $sub->created_at->diffForHumans() }}</span>
                            </div>
                        </a>
                        @empty
                        @for ($i = 0; $i < 4; $i++)
                        <a href="#" class="group flex gap-3">
                            <div class="w-16 sm:w-20 h-12 sm:h-16 bg-gradient-to-br from-vnn-dark to-slate-800 rounded overflow-hidden shrink-0 flex items-center justify-center">
                                <span class="text-white/15 font-extrabold">{{ substr($sec['category']->name, 0, 1) }}</span>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold leading-snug text-gray-900 dark:text-white group-hover:text-vnn-red transition line-clamp-2 font-heading">{{ $sec['category']->name }} headline {{ $i + 1 }} that covers important developments</h4>
                                <span class="text-xs text-gray-400 dark:text-gray-500">{{ $i + 1 }} hour{{ $i > 0 ? 's' : '' }} ago</span>
                            </div>
                        </a>
                        @endfor
                        @endforelse
                    </div>
                </div>
                @else
                {{-- Fallback section when no data --}}
                <div>
                    <div class="flex items-center gap-3 mb-5 border-b-2 border-vnn-red pb-2">
                        <h2 class="text-lg font-extrabold text-vnn-dark dark:text-white uppercase tracking-tight font-heading">{{ ucfirst($slug) }}</h2>
                        <div class="flex-1"></div>
                        <a href="{{ route('frontend.category', $slug) }}" class="text-xs text-vnn-red font-semibold hover:underline">See All →</a>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <a href="#" class="group md:col-span-2">
                            <div class="aspect-[16/9] bg-gradient-to-br from-vnn-red/60 to-vnn-dark rounded overflow-hidden flex items-center justify-center mb-3">
                                <span class="text-white/15 font-extrabold text-4xl">{{ strtoupper(substr($slug, 0, 1)) }}</span>
                            </div>
                            <span class="text-vnn-red text-xs font-bold uppercase tracking-wide">{{ ucfirst($slug) }}</span>
                            <h3 class="text-lg font-bold leading-snug mt-1 text-gray-900 dark:text-white group-hover:text-vnn-red transition font-heading">Latest {{ ucfirst($slug) }} stories and updates from Verve News Network</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 line-clamp-2 font-body">Stay informed with the latest {{ $slug }} news, analysis, and in-depth reporting from our team of journalists.</p>
                        </a>
                        @for ($i = 0; $i < 4; $i++)
                        <a href="#" class="group flex gap-3">
                            <div class="w-16 sm:w-20 h-12 sm:h-16 bg-gradient-to-br from-vnn-dark to-slate-800 rounded overflow-hidden shrink-0 flex items-center justify-center">
                                <span class="text-white/15 font-extrabold">{{ strtoupper(substr($slug, 0, 1)) }}</span>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold leading-snug text-gray-900 dark:text-white group-hover:text-vnn-red transition line-clamp-2 font-heading">{{ ucfirst($slug) }} headline {{ $i + 1 }} that covers important developments</h4>
                                <span class="text-xs text-gray-400 dark:text-gray-500">{{ $i + 1 }} hour{{ $i > 0 ? 's' : '' }} ago</span>
                            </div>
                        </a>
                        @endfor
                    </div>
                </div>
                @endif
            @endforeach

            {{-- Ad --}}
            @if(isset($advertisements['inline']) && $advertisements['inline']->isNotEmpty())
                @php $ad = $advertisements['inline']->random(); @endphp
                @if($ad->script_code)
                    {!! $ad->script_code !!}
                @elseif($ad->media_file)
                    <a href="{{ $ad->link ?? '#' }}" target="_blank" rel="noopener" class="block overflow-hidden rounded-lg border border-gray-200 dark:border-gray-700">
                        @if($ad->media_type === 'video')
                        <div class="relative w-full" style="padding-top: 25%;">
                            <video src="{{ asset('storage/' . $ad->media_file) }}" class="absolute inset-0 w-full h-full object-cover" muted playsinline onmouseenter="this.play()" onmouseleave="this.pause();this.currentTime=0;"></video>
                        </div>
                        @else
                        <img src="{{ asset('storage/' . $ad->media_file) }}" alt="{{ $ad->title }}" class="w-full h-32 object-cover">
                        @endif
                    </a>
                @elseif($ad->image_url)
                    <a href="{{ $ad->link ?? '#' }}" target="_blank" rel="noopener" class="block overflow-hidden rounded-lg border border-gray-200 dark:border-gray-700">
                        <img src="{{ $ad->image_url }}" alt="{{ $ad->title }}" class="w-full h-32 object-cover">
                    </a>
                @else
                    <div class="bg-vnn-gray dark:bg-vnn-dark-light border border-gray-200 dark:border-gray-700 rounded h-32 flex items-center justify-center text-gray-400 dark:text-gray-500 text-sm">{{ $ad->title }}</div>
                @endif
            @else
            <div class="bg-vnn-gray dark:bg-vnn-dark-light border border-gray-200 dark:border-gray-700 rounded h-24 flex items-center justify-center text-gray-400 dark:text-gray-500 text-sm">Advertisement</div>
            @endif

            {{-- Opinion & Editorial --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <div class="flex items-center gap-3 mb-4 border-b-2 border-vnn-red pb-2">
                        <h2 class="text-lg font-extrabold text-vnn-dark dark:text-white uppercase tracking-tight font-heading">Opinion</h2>
                        <div class="flex-1"></div>
                        <a href="{{ route('frontend.category', 'opinion') }}" class="text-xs text-vnn-blue font-semibold hover:underline">See All →</a>
                    </div>
                    <div class="space-y-4">
                        @forelse($opinions as $opinion)
                        <div class="bg-white dark:bg-vnn-dark-light p-4 rounded shadow-sm border-l-4 border-vnn-blue">
                            <h3 class="text-sm font-bold leading-snug font-heading"><a href="{{ route('frontend.article', $opinion->slug) }}" class="text-gray-900 dark:text-white hover:text-vnn-red transition">{{ $opinion->title }}</a></h3>
                            <div class="flex items-center gap-2 mt-2 text-xs text-gray-400 dark:text-gray-500">
                            <span>Published by <span class="font-bold text-vnn-red">VNN</span></span>
                                <span>•</span>
                                <span>{{ $opinion->publication_date?->format('F j, Y') ?? $opinion->created_at->format('F j, Y') }}</span>
                            </div>
                        </div>
                        @empty
                        @for ($i = 0; $i < 3; $i++)
                        <div class="bg-white dark:bg-vnn-dark-light p-4 rounded shadow-sm border-l-4 border-vnn-blue">
                            <h3 class="text-sm font-bold leading-snug font-heading"><a href="#" class="text-gray-900 dark:text-white hover:text-vnn-red transition">Thought-Provoking Opinion Piece on Nigeria's Political Landscape and Democratic Future</a></h3>
                            <div class="flex items-center gap-2 mt-2 text-xs text-gray-400 dark:text-gray-500">
                                <span>By Dr. Amina Bello</span>
                                <span>•</span>
                                <span>June {{ 23 - $i }}, 2026</span>
                            </div>
                        </div>
                        @endfor
                        @endforelse
                    </div>
                </div>
                <div>
                    <div class="flex items-center gap-3 mb-4 border-b-2 border-vnn-red pb-2">
                        <h2 class="text-lg font-extrabold text-vnn-dark dark:text-white uppercase tracking-tight font-heading">Editorial</h2>
                        <div class="flex-1"></div>
                        <a href="{{ route('frontend.category', 'editorial') }}" class="text-xs text-vnn-red font-semibold hover:underline">See All →</a>
                    </div>
                    <div class="space-y-4">
                        @forelse($editorials as $editorial)
                        <div class="bg-white dark:bg-vnn-dark-light p-4 rounded shadow-sm border-l-4 border-vnn-red">
                            <h3 class="text-sm font-bold leading-snug font-heading"><a href="{{ route('frontend.article', $editorial->slug) }}" class="text-gray-900 dark:text-white hover:text-vnn-red transition">{{ $editorial->title }}</a></h3>
                            <div class="flex items-center gap-2 mt-2 text-xs text-gray-400 dark:text-gray-500">
                                <span>{{ $editorial->publication_date?->format('F j, Y') ?? $editorial->created_at->format('F j, Y') }}</span>
                            </div>
                        </div>
                        @empty
                        @for ($i = 0; $i < 3; $i++)
                        <div class="bg-white dark:bg-vnn-dark-light p-4 rounded shadow-sm border-l-4 border-vnn-red">
                            <h3 class="text-sm font-bold leading-snug font-heading"><a href="#" class="text-gray-900 dark:text-white hover:text-vnn-red transition">The renewed Lagos monthly sanitation exercise: Matters arising</a></h3>
                            <div class="flex items-center gap-2 mt-2 text-xs text-gray-400 dark:text-gray-500">
                                <span>June {{ 26 - $i }}, 2026</span>
                            </div>
                        </div>
                        @endfor
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- Editor's Pick --}}
            @if($editorPicks->isNotEmpty())
            <div>
                <div class="flex items-center gap-3 mb-5 border-b-2 border-vnn-blue pb-2">
                    <h2 class="text-lg font-extrabold text-vnn-dark dark:text-white uppercase tracking-tight font-heading">Editor's Pick</h2>
                    <div class="flex-1"></div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    @foreach($editorPicks as $pick)
                    <a href="{{ route('frontend.article', $pick->slug) }}" class="group block hover:-translate-y-1 transition-all duration-200">
                        @if($pick->featured_image)
                        <div class="aspect-video rounded overflow-hidden mb-3">
                            <img src="{{ asset('storage/' . $pick->featured_image) }}" alt="{{ $pick->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                        </div>
                        @else
                        <div class="aspect-video bg-gradient-to-br from-vnn-blue to-vnn-blue-dark rounded overflow-hidden flex items-center justify-center mb-3">
                            <span class="text-white/15 font-extrabold text-3xl">V</span>
                        </div>
                        @endif
                        @if($pick->category)
                        <span class="text-vnn-blue text-xs font-bold uppercase tracking-wide">{{ $pick->category->name }}</span>
                        @endif
                        <h3 class="text-sm font-bold leading-snug mt-1 text-gray-900 dark:text-white group-hover:text-vnn-red transition line-clamp-2 font-heading">{{ $pick->title }}</h3>
                        <p class="text-xs text-gray-400 dark:text-gray-500 mt-1 font-body">Published by <span class="font-bold text-vnn-red">VNN</span></p>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Video Section --}}
            <div>
                <div class="flex items-center gap-3 mb-5 border-b-2 border-vnn-blue pb-2">
                    <h2 class="text-lg font-extrabold text-vnn-dark dark:text-white uppercase tracking-tight font-heading">Video</h2>
                    <div class="flex-1"></div>
                    <a href="{{ route('frontend.video') }}" class="text-xs text-vnn-red font-semibold hover:underline">See All →</a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @forelse($videos as $video)
                    @php $hasVideo = $video->youtube_id || $video->video_file || $video->embed_code; @endphp
                    <div x-data="{ playing: false }" class="group block hover:-translate-y-1 transition-all duration-200">
                        {{-- Thumbnail / Player --}}
                        <div class="aspect-video rounded overflow-hidden relative mb-3 bg-black">
                            {{-- Player --}}
                            <template x-if="playing">
                                @if($video->youtube_id)
                                <iframe src="https://www.youtube.com/embed/{{ $video->youtube_id }}?autoplay=1&rel=0" class="absolute inset-0 w-full h-full" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                @elseif($video->video_file)
                                <video src="{{ asset('storage/' . $video->video_file) }}" controls autoplay class="absolute inset-0 w-full h-full object-cover"></video>
                                @elseif($video->embed_code)
                                <div class="absolute inset-0 w-full h-full">{!! $video->embed_code !!}</div>
                                @endif
                            </template>
                            {{-- Thumbnail --}}
                            <template x-if="!playing">
                                <div class="absolute inset-0" @click="if({{ $hasVideo ? 'true' : 'false' }}) playing = true">
                                    @if($video->thumbnail)
                                    <img src="{{ str_starts_with($video->thumbnail, 'http') ? $video->thumbnail : asset('storage/' . $video->thumbnail) }}" alt="{{ $video->title }}" class="w-full h-full object-cover">
                                    @else
                                    <div class="w-full h-full bg-gradient-to-br from-vnn-blue to-vnn-blue-dark flex items-center justify-center">
                                        <span class="text-white/15 font-extrabold text-3xl">V</span>
                                    </div>
                                    @endif
                                    @if($hasVideo)
                                    <div class="absolute inset-0 flex items-center justify-center cursor-pointer">
                                        <div class="w-12 h-12 bg-vnn-blue/90 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform duration-200">
                                            <svg class="w-5 h-5 text-white ml-0.5" fill="currentColor" viewBox="0 0 20 20"><path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/></svg>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </template>
                        </div>
                        <div class="flex items-start justify-between">
                            <div class="min-w-0 flex-1">
                                <h3 class="text-sm font-bold leading-snug text-gray-900 dark:text-white group-hover:text-vnn-red transition line-clamp-2 font-heading">{{ $video->title }}</h3>
                                <span class="text-xs text-gray-400 dark:text-gray-500 font-body">{{ $video->created_at->diffForHumans() }}</span>
                            </div>
                            @if($hasVideo)
                            <button @click="playing = !playing" class="shrink-0 ml-2 text-gray-400 hover:text-vnn-red transition" :title="playing ? 'Close' : 'Play'">
                                <svg x-show="!playing" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <svg x-show="playing" x-cloak class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                            @endif
                        </div>
                    </div>
                    @empty
                    @for ($i = 0; $i < 3; $i++)
                    <div class="group block">
                        <div class="aspect-video bg-gradient-to-br {{ $i === 0 ? 'from-vnn-red to-vnn-red-dark' : ($i === 1 ? 'from-vnn-dark to-slate-800' : 'from-slate-800 to-slate-950') }} rounded overflow-hidden relative flex items-center justify-center mb-3">
                            <span class="text-white/15 font-extrabold text-3xl">V</span>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="w-12 h-12 bg-vnn-red/90 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white ml-0.5" fill="currentColor" viewBox="0 0 20 20"><path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/></svg>
                                </div>
                            </div>
                        </div>
                        <h3 class="text-sm font-bold mt-2 leading-snug text-gray-900 dark:text-white line-clamp-2 font-heading">Video Title: Coverage of Major News Event and Expert Analysis</h3>
                        <span class="text-xs text-gray-400 dark:text-gray-500 font-body">12:34 • 2 hours ago</span>
                    </div>
                    @endfor
                    @endforelse
                </div>
            </div>

            {{-- Podcast Section --}}
            <div>
                <div class="flex items-center gap-3 mb-5 border-b-2 border-vnn-blue pb-2">
                    <h2 class="text-lg font-extrabold text-vnn-dark dark:text-white uppercase tracking-tight font-heading">Podcasts</h2>
                    <div class="flex-1"></div>
                    <a href="{{ route('frontend.podcast') }}" class="text-xs text-vnn-blue font-semibold hover:underline">See All →</a>
                </div>
                <div class="space-y-3">
                    @forelse($podcasts as $podcast)
                    @php $hasAudio = $podcast->audio_file || $podcast->audio_url; @endphp
                    <div x-data="{ playing: false }" class="bg-white dark:bg-vnn-dark-light rounded shadow-sm overflow-hidden hover:bg-vnn-gray dark:hover:bg-vnn-dark transition group hover:-translate-y-0.5 duration-200">
                        <div class="flex items-center gap-3 md:gap-4 p-3">
                            <div class="w-10 h-10 md:w-14 md:h-14 bg-vnn-blue rounded flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform cursor-pointer" @click="if({{ $hasAudio ? 'true' : 'false' }}) playing = !playing">
                                <svg x-show="!playing" class="w-5 h-5 md:w-6 md:h-6 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M18 3a1 1 0 00-1.196-.98l-10 2A1 1 0 006 5v9.114A4.369 4.369 0 005 14c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V7.82l8-1.6v5.894A4.37 4.37 0 0015 12c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V3z"/></svg>
                                <svg x-show="playing" x-cloak class="w-5 h-5 md:w-6 md:h-6 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zM7 8a1 1 0 012 0v4a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v4a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="text-sm font-bold text-gray-900 dark:text-white group-hover:text-vnn-red transition font-heading truncate">{{ $podcast->title }}</h3>
                                @if($podcast->episode_number)
                                <span class="text-xs text-gray-400 dark:text-gray-500 font-body">Ep {{ $podcast->episode_number }}@if($podcast->season_number) • Season {{ $podcast->season_number }}@endif</span>
                                @else
                                <span class="text-xs text-gray-400 dark:text-gray-500 font-body">{{ $podcast->created_at->diffForHumans() }}</span>
                                @endif
                            </div>
                            @if($hasAudio)
                            <button @click="playing = !playing" class="shrink-0 text-gray-400 hover:text-vnn-blue transition" :title="playing ? 'Pause' : 'Play'">
                                <svg x-show="!playing" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <svg x-show="playing" x-cloak class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9v6m4-6v6"/></svg>
                            </button>
                            @endif
                        </div>
                        @if($hasAudio)
                        <div x-show="playing" x-cloak class="px-3 pb-3 -mt-1">
                            <audio x-init="$watch('playing', v => { if(v) $el.play(); else { $el.pause(); $el.currentTime = 0; } })" src="{{ $podcast->audio_file ? asset('storage/' . $podcast->audio_file) : $podcast->audio_url }}" controls class="w-full h-8"></audio>
                        </div>
                        @endif
                    </div>
                    @empty
                    @for ($i = 0; $i < 3; $i++)
                    <div class="flex items-center gap-3 md:gap-4 p-3 bg-white dark:bg-vnn-dark-light rounded shadow-sm">
                        <div class="w-10 h-10 md:w-14 md:h-14 bg-vnn-blue rounded flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 md:w-6 md:h-6 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M18 3a1 1 0 00-1.196-.98l-10 2A1 1 0 006 5v9.114A4.369 4.369 0 005 14c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V7.82l8-1.6v5.894A4.37 4.37 0 0015 12c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V3z"/></svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="text-sm font-bold text-gray-900 dark:text-white font-heading truncate">VNN Daily Podcast: Episode {{ $i + 100 }}</h3>
                            <span class="text-xs text-gray-400 dark:text-gray-500 font-body">Season {{ $i + 1 }}, Ep {{ $i + 100 }}</span>
                        </div>
                    </div>
                    @endfor
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Sidebar --}}
        <aside class="lg:col-span-5 space-y-5">
            {{-- Latest News --}}
            <div>
                <div class="flex items-center gap-3 mb-4 border-b-2 border-vnn-red pb-2">
                    <h3 class="text-base font-extrabold text-vnn-dark dark:text-white uppercase tracking-tight font-heading">Latest</h3>
                    <div class="flex-1"></div>
                </div>
                <div class="space-y-3">
                    @forelse($latest as $item)
                    <a href="{{ route('frontend.article', $item->slug) }}" class="flex gap-4 group {{ !$loop->last ? 'pb-4 border-b border-gray-100 dark:border-gray-800' : '' }}">
                        @if($item->featured_image)
                        <div class="w-20 sm:w-32 h-16 sm:h-24 rounded overflow-hidden shrink-0">
                            <img src="{{ asset('storage/' . $item->featured_image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                        </div>
                        @else
                        <div class="w-20 sm:w-32 h-16 sm:h-24 bg-gradient-to-br from-vnn-dark to-slate-800 rounded overflow-hidden shrink-0 flex items-center justify-center">
                            <span class="text-white/15 font-extrabold text-2xl">V</span>
                        </div>
                        @endif
                        <div class="flex-1 min-w-0">
                            @if($item->category)
                            <span class="text-vnn-red text-[10px] font-bold uppercase tracking-wide">{{ $item->category->name }}</span>
                            @endif
                            <h4 class="text-sm font-bold leading-snug mt-0.5 text-gray-900 dark:text-white group-hover:text-vnn-red transition line-clamp-2 font-heading">{{ $item->title }}</h4>
                        </div>
                    </a>
                    @empty
                    @for ($i = 0; $i < 6; $i++)
                    <a href="#" class="flex gap-4 group {{ $i < 5 ? 'pb-4 border-b border-gray-100 dark:border-gray-800' : '' }}">
                        <div class="w-20 sm:w-32 h-16 sm:h-24 bg-gradient-to-br from-vnn-dark to-slate-800 rounded overflow-hidden shrink-0 flex items-center justify-center">
                            <span class="text-white/15 font-extrabold text-2xl">V</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <span class="text-vnn-red text-[10px] font-bold uppercase tracking-wide">{{ ['Politics', 'Business', 'Tech', 'Sports', 'World', 'Entertainment'][$i] }}</span>
                            <h4 class="text-sm font-bold leading-snug mt-0.5 text-gray-900 dark:text-white group-hover:text-vnn-red transition line-clamp-2 font-heading">Latest news headline number {{ $i + 1 }} that is breaking now</h4>
                        </div>
                    </a>
                    @endfor
                    @endforelse
                </div>
            </div>

            {{-- Ad --}}
            @if(isset($advertisements['sidebar']) && $advertisements['sidebar']->isNotEmpty())
                @php $ad = $advertisements['sidebar']->random(); @endphp
                @if($ad->script_code)
                    {!! $ad->script_code !!}
                @elseif($ad->media_file)
                    <a href="{{ $ad->link ?? '#' }}" target="_blank" rel="noopener" class="block overflow-hidden rounded-lg border border-gray-200 dark:border-gray-700">
                        @if($ad->media_type === 'video')
                        <div class="relative w-full" style="padding-top: 125%;">
                            <video src="{{ asset('storage/' . $ad->media_file) }}" class="absolute inset-0 w-full h-full object-cover" muted playsinline onmouseenter="this.play()" onmouseleave="this.pause();this.currentTime=0;"></video>
                        </div>
                        @else
                        <img src="{{ asset('storage/' . $ad->media_file) }}" alt="{{ $ad->title }}" class="w-full h-64 object-cover">
                        @endif
                    </a>
                @elseif($ad->image_url)
                    <a href="{{ $ad->link ?? '#' }}" target="_blank" rel="noopener" class="block overflow-hidden rounded-lg border border-gray-200 dark:border-gray-700">
                        <img src="{{ $ad->image_url }}" alt="{{ $ad->title }}" class="w-full h-64 object-cover">
                    </a>
                @else
                    <div class="bg-vnn-gray dark:bg-vnn-dark-light border border-gray-200 dark:border-gray-700 rounded h-64 flex items-center justify-center text-gray-400 dark:text-gray-500 text-sm">{{ $ad->title }}</div>
                @endif
            @else
            <div class="bg-vnn-gray dark:bg-vnn-dark-light border border-gray-200 dark:border-gray-700 rounded h-64 flex items-center justify-center text-gray-400 dark:text-gray-500 text-sm">Advertisement</div>
            @endif

            {{-- Most Read --}}
            <div>
                <div class="flex items-center gap-3 mb-4 border-b-2 border-vnn-red pb-2">
                    <h3 class="text-base font-extrabold text-vnn-dark dark:text-white uppercase tracking-tight font-heading">Most Read</h3>
                    <div class="flex-1"></div>
                </div>
                <div class="space-y-3">
                    @forelse($mostRead as $item)
                    <a href="{{ route('frontend.article', $item->slug) }}" class="flex gap-4 group {{ !$loop->last ? 'pb-4 border-b border-gray-100 dark:border-gray-800' : '' }}">
                        @if($item->featured_image)
                        <div class="w-20 sm:w-32 h-16 sm:h-24 rounded overflow-hidden shrink-0">
                            <img src="{{ asset('storage/' . $item->featured_image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                        </div>
                        @else
                        <div class="w-20 sm:w-32 h-16 sm:h-24 bg-gradient-to-br from-vnn-red/20 to-vnn-blue/20 rounded overflow-hidden shrink-0 flex items-center justify-center">
                            <span class="text-vnn-red/40 font-bold text-2xl font-heading">{{ strtoupper(substr($item->title, 0, 1)) }}</span>
                        </div>
                        @endif
                        <div class="flex-1 min-w-0">
                            <h4 class="text-sm font-bold leading-snug text-gray-900 dark:text-white group-hover:text-vnn-red transition line-clamp-2 font-heading">{{ $item->title }}</h4>
                            <span class="text-xs text-gray-400 dark:text-gray-500 font-body mt-1 inline-block">{{ $item->publication_date?->diffForHumans() }}</span>
                        </div>
                    </a>
                    @empty
                    @for ($i = 0; $i < 5; $i++)
                    <a href="#" class="flex gap-4 group {{ $i < 4 ? 'pb-4 border-b border-gray-100 dark:border-gray-800' : '' }}">
                        <div class="w-20 sm:w-32 h-16 sm:h-24 bg-gradient-to-br from-vnn-red/10 to-vnn-blue/10 rounded overflow-hidden shrink-0 flex items-center justify-center">
                            <span class="text-vnn-red/30 font-bold text-2xl font-heading">{{ $i + 1 }}</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="text-sm font-bold leading-snug text-gray-900 dark:text-white group-hover:text-vnn-red transition line-clamp-2 font-heading">Most read story number {{ $i + 1 }} that everyone is talking about</h4>
                            <span class="text-xs text-gray-400 dark:text-gray-500 font-body mt-1 inline-block">{{ rand(1000, 50000) }} views</span>
                        </div>
                    </a>
                    @endfor
                    @endforelse
                </div>
            </div>

            {{-- VNN List --}}
            <div>
                <div class="flex items-center gap-3 mb-4 border-b-2 border-vnn-red pb-2">
                    <h3 class="text-base font-extrabold text-vnn-dark dark:text-white uppercase tracking-tight font-heading">VNN List</h3>
                    <a href="{{ route('frontend.vnn-list') }}" class="text-vnn-red text-[10px] font-bold uppercase tracking-wide hover:underline ml-auto">See All</a>
                </div>
                <div class="space-y-3">
                    @forelse($vnnListArticles as $item)
                    <a href="{{ route('frontend.article', $item->slug) }}" class="flex gap-3 group {{ !$loop->last ? 'pb-3 border-b border-gray-100 dark:border-gray-800' : '' }}">
                        @if($item->featured_image)
                        <div class="w-20 h-16 rounded overflow-hidden shrink-0">
                            <img src="{{ asset('storage/' . $item->featured_image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                        </div>
                        @else
                        <div class="w-20 h-16 bg-gradient-to-br from-vnn-red/20 to-vnn-blue/20 rounded overflow-hidden shrink-0 flex items-center justify-center">
                            <span class="text-vnn-red/40 font-bold text-lg font-heading">V</span>
                        </div>
                        @endif
                        <div class="flex-1 min-w-0">
                            <h4 class="text-sm font-bold leading-snug text-gray-900 dark:text-white group-hover:text-vnn-red transition line-clamp-2 font-heading">{{ $item->title }}</h4>
                            <span class="text-[10px] text-gray-400 dark:text-gray-500 font-body mt-0.5 inline-block">{{ $item->publication_date?->diffForHumans() }}</span>
                        </div>
                    </a>
                    @empty
                    @for ($i = 0; $i < 4; $i++)
                    <a href="#" class="flex gap-3 group {{ $i < 3 ? 'pb-3 border-b border-gray-100 dark:border-gray-800' : '' }}">
                        <div class="w-20 h-16 bg-gradient-to-br from-vnn-red/10 to-vnn-blue/10 rounded overflow-hidden shrink-0 flex items-center justify-center">
                            <span class="text-vnn-red/30 font-bold text-lg font-heading">V</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="text-sm font-bold leading-snug text-gray-900 dark:text-white group-hover:text-vnn-red transition line-clamp-2 font-heading">VNN List story headline {{ $i + 1 }}</h4>
                            <span class="text-[10px] text-gray-400 dark:text-gray-500 font-body mt-0.5 inline-block">{{ now()->subHours(rand(1, 48))->diffForHumans() }}</span>
                        </div>
                    </a>
                    @endfor
                    @endforelse
                </div>
            </div>

            {{-- Documentary --}}
            <div>
                <div class="flex items-center gap-3 mb-4 border-b-2 border-vnn-red pb-2">
                    <h3 class="text-base font-extrabold text-vnn-dark dark:text-white uppercase tracking-tight font-heading">Documentary</h3>
                    <a href="{{ route('frontend.documentary') }}" class="text-vnn-red text-[10px] font-bold uppercase tracking-wide hover:underline ml-auto">See All</a>
                </div>
                <div class="space-y-4">
                    @forelse($documentaryArticles as $item)
                    <div x-data="{ playing: false, src: '{{ $item->youtube_url ? 'https://www.youtube.com/embed/' . $item->getYoutubeIdAttribute() : ($item->media_file ? asset('storage/' . $item->media_file) : '') }}', type: '{{ $item->media_type ?? 'youtube' }}' }" class="group {{ !$loop->last ? 'pb-4 border-b border-gray-100 dark:border-gray-800' : '' }}">
                        <div class="w-full aspect-video bg-gradient-to-br from-vnn-blue/20 to-vnn-dark/20 rounded-lg overflow-hidden relative cursor-pointer" @click="if(src) { playing = !playing }">
                            <template x-if="!playing">
                                <div class="absolute inset-0">
                                    @if($item->featured_image)
                                    <img src="{{ asset('storage/' . $item->featured_image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                    @else
                                    <div class="w-full h-full flex items-center justify-center bg-vnn-dark/10">
                                        <span class="text-vnn-blue/30 font-bold text-3xl font-heading">&#9654;</span>
                                    </div>
                                    @endif
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <span class="w-10 h-10 bg-vnn-red/90 rounded-full flex items-center justify-center text-white text-sm font-bold shadow-lg">&#9654;</span>
                                    </div>
                                </div>
                            </template>
                            <template x-if="playing">
                                <div class="w-full h-full">
                                    <template x-if="type === 'youtube'">
                                        <iframe :src="src + '?autoplay=1'" class="w-full h-full" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                    </template>
                                    <template x-if="type !== 'youtube'">
                                        <video :src="src" controls autoplay class="w-full h-full object-cover"></video>
                                    </template>
                                </div>
                            </template>
                        </div>
                        <a href="{{ route('frontend.article', $item->slug) }}" class="block mt-2">
                            <h4 class="text-sm font-bold leading-snug text-gray-900 dark:text-white group-hover:text-vnn-red transition line-clamp-2 font-heading">{{ $item->title }}</h4>
                            <span class="text-[10px] text-gray-400 dark:text-gray-500 font-body mt-0.5 inline-block">{{ $item->publication_date?->diffForHumans() }}</span>
                        </a>
                    </div>
                    @empty
                    @for ($i = 0; $i < 2; $i++)
                    <div class="{{ $i < 1 ? 'pb-4 border-b border-gray-100 dark:border-gray-800' : '' }}">
                        <div class="w-full aspect-video bg-gradient-to-br from-vnn-blue/10 to-vnn-dark/10 rounded-lg overflow-hidden flex items-center justify-center relative">
                            <span class="text-vnn-blue/20 font-bold text-3xl font-heading">&#9654;</span>
                        </div>
                        <div class="mt-2">
                            <h4 class="text-sm font-bold leading-snug text-gray-900 dark:text-white line-clamp-2 font-heading">Documentary feature story {{ $i + 1 }}</h4>
                            <span class="text-[10px] text-gray-400 dark:text-gray-500 font-body mt-0.5 inline-block">{{ now()->subHours(rand(1, 48))->diffForHumans() }}</span>
                        </div>
                    </div>
                    @endfor
                    @endforelse
                </div>
            </div>

            {{-- Tech Start Ups --}}
            <div>
                <div class="flex items-center gap-3 mb-4 border-b-2 border-vnn-red pb-2">
                    <h3 class="text-base font-extrabold text-vnn-dark dark:text-white uppercase tracking-tight font-heading">Tech Start Ups</h3>
                    <a href="{{ route('frontend.tech-start-ups') }}" class="text-vnn-red text-[10px] font-bold uppercase tracking-wide hover:underline ml-auto">See All</a>
                </div>
                <div class="space-y-3">
                    @forelse($techStartupsArticles as $item)
                    <a href="{{ route('frontend.article', $item->slug) }}" class="flex gap-3 group {{ !$loop->last ? 'pb-3 border-b border-gray-100 dark:border-gray-800' : '' }}">
                        @if($item->featured_image)
                        <div class="w-20 h-16 rounded overflow-hidden shrink-0">
                            <img src="{{ asset('storage/' . $item->featured_image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                        </div>
                        @else
                        <div class="w-20 h-16 bg-gradient-to-br from-vnn-blue/20 to-vnn-red/20 rounded overflow-hidden shrink-0 flex items-center justify-center">
                            <span class="text-vnn-blue/40 font-bold text-lg font-heading">T</span>
                        </div>
                        @endif
                        <div class="flex-1 min-w-0">
                            <h4 class="text-sm font-bold leading-snug text-gray-900 dark:text-white group-hover:text-vnn-red transition line-clamp-2 font-heading">{{ $item->title }}</h4>
                            <span class="text-[10px] text-gray-400 dark:text-gray-500 font-body mt-0.5 inline-block">{{ $item->publication_date?->diffForHumans() }}</span>
                        </div>
                    </a>
                    @empty
                    @for ($i = 0; $i < 3; $i++)
                    <a href="#" class="flex gap-3 group {{ $i < 2 ? 'pb-3 border-b border-gray-100 dark:border-gray-800' : '' }}">
                        <div class="w-20 h-16 bg-gradient-to-br from-vnn-blue/10 to-vnn-red/10 rounded overflow-hidden shrink-0 flex items-center justify-center">
                            <span class="text-vnn-blue/30 font-bold text-lg font-heading">T</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="text-sm font-bold leading-snug text-gray-900 dark:text-white group-hover:text-vnn-red transition line-clamp-2 font-heading">Tech startup story headline {{ $i + 1 }}</h4>
                            <span class="text-[10px] text-gray-400 dark:text-gray-500 font-body mt-0.5 inline-block">{{ now()->subHours(rand(1, 48))->diffForHumans() }}</span>
                        </div>
                    </a>
                    @endfor
                    @endforelse
                </div>
            </div>

            {{-- Latest Gadgets --}}
            <div>
                <div class="flex items-center gap-3 mb-4 border-b-2 border-vnn-red pb-2">
                    <h3 class="text-base font-extrabold text-vnn-dark dark:text-white uppercase tracking-tight font-heading">Latest Gadgets</h3>
                    <a href="{{ route('frontend.latest-gadgets') }}" class="text-vnn-red text-[10px] font-bold uppercase tracking-wide hover:underline ml-auto">See All</a>
                </div>
                <div class="space-y-3">
                    @forelse($latestGadgetsArticles as $item)
                    <a href="{{ route('frontend.article', $item->slug) }}" class="flex gap-3 group {{ !$loop->last ? 'pb-3 border-b border-gray-100 dark:border-gray-800' : '' }}">
                        @if($item->featured_image)
                        <div class="w-20 h-16 rounded overflow-hidden shrink-0">
                            <img src="{{ asset('storage/' . $item->featured_image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                        </div>
                        @else
                        <div class="w-20 h-16 bg-gradient-to-br from-vnn-dark/20 to-vnn-blue/20 rounded overflow-hidden shrink-0 flex items-center justify-center">
                            <span class="text-vnn-dark/40 font-bold text-lg font-heading">G</span>
                        </div>
                        @endif
                        <div class="flex-1 min-w-0">
                            <h4 class="text-sm font-bold leading-snug text-gray-900 dark:text-white group-hover:text-vnn-red transition line-clamp-2 font-heading">{{ $item->title }}</h4>
                            <span class="text-[10px] text-gray-400 dark:text-gray-500 font-body mt-0.5 inline-block">{{ $item->publication_date?->diffForHumans() }}</span>
                        </div>
                    </a>
                    @empty
                    @for ($i = 0; $i < 3; $i++)
                    <a href="#" class="flex gap-3 group {{ $i < 2 ? 'pb-3 border-b border-gray-100 dark:border-gray-800' : '' }}">
                        <div class="w-20 h-16 bg-gradient-to-br from-vnn-dark/10 to-vnn-blue/10 rounded overflow-hidden shrink-0 flex items-center justify-center">
                            <span class="text-vnn-dark/30 font-bold text-lg font-heading">G</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="text-sm font-bold leading-snug text-gray-900 dark:text-white group-hover:text-vnn-red transition line-clamp-2 font-heading">Latest gadget review headline {{ $i + 1 }}</h4>
                            <span class="text-[10px] text-gray-400 dark:text-gray-500 font-body mt-0.5 inline-block">{{ now()->subHours(rand(1, 48))->diffForHumans() }}</span>
                        </div>
                    </a>
                    @endfor
                    @endforelse
                </div>
            </div>

            {{-- Social Trends --}}
            <div>
                <div class="flex items-center gap-3 mb-4 border-b-2 border-vnn-red pb-2">
                    <h3 class="text-base font-extrabold text-vnn-dark dark:text-white uppercase tracking-tight font-heading">Social Trends</h3>
                </div>
                <div class="space-y-4">
                    @forelse($socialTrendsArticles as $item)
                    <a href="{{ route('frontend.social-trend', $item->slug) }}" class="block group {{ !$loop->last ? 'pb-4 border-b border-gray-100 dark:border-gray-800' : '' }}">
                        <div class="w-full aspect-video bg-gradient-to-br from-vnn-blue/20 to-vnn-dark/20 rounded-lg overflow-hidden relative">
                            @if($item->media_content_type === 'image' && $item->image_file)
                                <img src="{{ asset('storage/' . $item->image_file) }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                            @elseif($item->media_content_type === 'video' && $item->featured_image)
                                <img src="{{ asset('storage/' . $item->featured_image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <span class="w-10 h-10 bg-vnn-red/90 rounded-full flex items-center justify-center text-white text-sm font-bold shadow-lg">&#9654;</span>
                                </div>
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-vnn-dark/10">
                                    <span class="text-vnn-blue/30 font-bold text-3xl font-heading">&#9654;</span>
                                </div>
                            @endif
                        </div>
                        <div class="mt-2">
                            <h4 class="text-sm font-bold leading-snug text-gray-900 dark:text-white group-hover:text-vnn-red transition line-clamp-2 font-heading">{{ $item->title }}</h4>
                            <div class="flex items-center gap-2 mt-0.5">
                                @if($item->social_platform)
                                <span class="px-1.5 py-0.5 bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-400 text-[9px] font-bold uppercase rounded">{{ $item->social_platform }}</span>
                                @endif
                                <span class="text-[10px] text-gray-400 dark:text-gray-500 font-body">{{ $item->publication_date?->diffForHumans() }}</span>
                            </div>
                        </div>
                    </a>
                    @empty
                    @for ($i = 0; $i < 2; $i++)
                    <div class="{{ $i < 1 ? 'pb-4 border-b border-gray-100 dark:border-gray-800' : '' }}">
                        <div class="w-full aspect-video bg-gradient-to-br from-vnn-blue/10 to-vnn-dark/10 rounded-lg overflow-hidden flex items-center justify-center relative">
                            <span class="text-vnn-blue/20 font-bold text-3xl font-heading">&#9654;</span>
                        </div>
                        <div class="mt-2">
                            <h4 class="text-sm font-bold leading-snug text-gray-900 dark:text-white line-clamp-2 font-heading">Trending social post {{ $i + 1 }}</h4>
                            <span class="text-[10px] text-gray-400 dark:text-gray-500 font-body mt-0.5 inline-block">{{ now()->subHours(rand(1, 48))->diffForHumans() }}</span>
                        </div>
                    </div>
                    @endfor
                    @endforelse
                </div>
            </div>

            {{-- Latest Release --}}
            <div>
                <div class="flex items-center gap-3 mb-4 border-b-2 border-vnn-red pb-2">
                    <h3 class="text-base font-extrabold text-vnn-dark dark:text-white uppercase tracking-tight font-heading">Latest Release</h3>
                </div>
                <div class="space-y-4">
                    @forelse($latestReleaseArticles as $item)
                    <div x-data="{ playing: false, src: '{{ $item->youtube_url ? 'https://www.youtube.com/embed/' . $item->getYoutubeIdAttribute() : ($item->media_file ? asset('storage/' . $item->media_file) : '') }}', type: '{{ $item->media_type ?? 'youtube' }}' }" class="group {{ !$loop->last ? 'pb-4 border-b border-gray-100 dark:border-gray-800' : '' }}">
                        <div class="w-full aspect-video bg-gradient-to-br from-vnn-red/20 to-vnn-blue/20 rounded-lg overflow-hidden relative cursor-pointer" @click="if(src) { playing = !playing }">
                            <template x-if="!playing">
                                <div class="absolute inset-0">
                                    @if($item->featured_image)
                                    <img src="{{ asset('storage/' . $item->featured_image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                    @else
                                    <div class="w-full h-full flex items-center justify-center bg-vnn-dark/10">
                                        <span class="text-vnn-red/30 font-bold text-3xl font-heading">&#9654;</span>
                                    </div>
                                    @endif
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <span class="w-10 h-10 bg-vnn-red/90 rounded-full flex items-center justify-center text-white text-sm font-bold shadow-lg">&#9654;</span>
                                    </div>
                                </div>
                            </template>
                            <template x-if="playing">
                                <div class="w-full h-full">
                                    <template x-if="type === 'youtube'">
                                        <iframe :src="src + '?autoplay=1'" class="w-full h-full" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                    </template>
                                    <template x-if="type !== 'youtube'">
                                        <video :src="src" controls autoplay class="w-full h-full object-cover"></video>
                                    </template>
                                </div>
                            </template>
                        </div>
                        <a href="{{ route('frontend.article', $item->slug) }}" class="block mt-2">
                            <h4 class="text-sm font-bold leading-snug text-gray-900 dark:text-white group-hover:text-vnn-red transition line-clamp-2 font-heading">{{ $item->title }}</h4>
                            <span class="text-[10px] text-gray-400 dark:text-gray-500 font-body mt-0.5 inline-block">{{ $item->publication_date?->diffForHumans() }}</span>
                        </a>
                    </div>
                    @empty
                    @for ($i = 0; $i < 2; $i++)
                    <div class="{{ $i < 1 ? 'pb-4 border-b border-gray-100 dark:border-gray-800' : '' }}">
                        <div class="w-full aspect-video bg-gradient-to-br from-vnn-red/10 to-vnn-blue/10 rounded-lg overflow-hidden flex items-center justify-center relative">
                            <span class="text-vnn-red/20 font-bold text-3xl font-heading">&#9654;</span>
                        </div>
                        <div class="mt-2">
                            <h4 class="text-sm font-bold leading-snug text-gray-900 dark:text-white line-clamp-2 font-heading">Latest release headline {{ $i + 1 }}</h4>
                            <span class="text-[10px] text-gray-400 dark:text-gray-500 font-body mt-0.5 inline-block">{{ now()->subHours(rand(1, 48))->diffForHumans() }}</span>
                        </div>
                    </div>
                    @endfor
                    @endforelse
                </div>
            </div>

            {{-- Newsletter --}}
            <div class="bg-gradient-to-br from-vnn-blue to-vnn-blue-dark rounded-lg p-6 text-white">
                <h3 class="font-extrabold text-lg font-heading">Stay Informed</h3>
                <p class="text-sm text-gray-300 mt-1 font-body">Get the latest news delivered to your inbox every morning.</p>
                @livewire('newsletter-subscribe', ['layout' => 'vertical'], key('sidebar-subscribe'))
                <p class="text-xs text-gray-400 mt-2">No spam. Unsubscribe anytime.</p>
            </div>

            {{-- Gallery --}}
            <div>
                <div class="flex items-center gap-3 mb-4 border-b-2 border-vnn-blue pb-2">
                    <h3 class="text-base font-extrabold text-vnn-dark dark:text-white uppercase tracking-tight font-heading">Gallery</h3>
                    <div class="flex-1"></div>
                </div>
                @if($galleryImages->count())
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-2">
                    @foreach($galleryImages->take(8) as $image)
                    <a href="#" class="aspect-square bg-gray-100 dark:bg-vnn-dark-light rounded overflow-hidden group">
                        <img src="{{ asset('storage/' . $image->image) }}" alt="{{ $image->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                    </a>
                    @endforeach
                </div>
                @else
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-2">
                    @for ($i = 0; $i < 4; $i++)
                    <a href="#" class="aspect-square bg-gradient-to-br {{ $i % 2 ? 'from-vnn-red to-vnn-red-dark' : 'from-vnn-dark to-slate-800' }} rounded overflow-hidden flex items-center justify-center group">
                        <span class="text-white/20 font-extrabold text-2xl group-hover:scale-125 transition-transform duration-500">V</span>
                    </a>
                    @endfor
                </div>
                @endif
            </div>

            {{-- Tags --}}
            <div>
                <div class="flex items-center gap-3 mb-4 border-b-2 border-vnn-red pb-2">
                    <h3 class="text-base font-extrabold text-vnn-dark dark:text-white uppercase tracking-tight font-heading">Tags</h3>
                    <div class="flex-1"></div>
                </div>
                <div class="flex flex-wrap gap-2">
                    @foreach(['Economy', 'Elections', 'Security', 'Health', 'Education', 'Climate', 'Technology', 'Sports', 'Africa', 'World'] as $tag)
                    <a href="{{ route('frontend.tag', strtolower($tag)) }}" class="bg-vnn-gray dark:bg-vnn-dark-light text-gray-600 dark:text-gray-300 text-xs font-medium px-3 py-1.5 rounded hover:bg-vnn-red hover:text-white transition active:scale-95">{{ $tag }}</a>
                    @endforeach
                </div>
            </div>
        </aside>
    </div>
</section>

{{-- Bottom Ad --}}
<section class="max-w-7xl mx-auto px-4 py-4">
    @if(isset($advertisements['banner']) && $advertisements['banner']->count() > 2)
        @php $ad = $advertisements['banner']->slice(2)->random(); @endphp
        @if($ad->script_code)
            {!! $ad->script_code !!}
        @elseif($ad->media_file)
            <a href="{{ $ad->link ?? '#' }}" target="_blank" rel="noopener" class="block overflow-hidden rounded-lg border border-gray-200 dark:border-gray-700">
                @if($ad->media_type === 'video')
                <div class="relative w-full" style="padding-top: 25%;">
                    <video src="{{ asset('storage/' . $ad->media_file) }}" class="absolute inset-0 w-full h-full object-cover" muted playsinline onmouseenter="this.play()" onmouseleave="this.pause();this.currentTime=0;"></video>
                </div>
                @else
                <img src="{{ asset('storage/' . $ad->media_file) }}" alt="{{ $ad->title }}" class="w-full h-40 object-cover">
                @endif
            </a>
        @elseif($ad->image_url)
            <a href="{{ $ad->link ?? '#' }}" target="_blank" rel="noopener" class="block overflow-hidden rounded-lg border border-gray-200 dark:border-gray-700">
                <img src="{{ $ad->image_url }}" alt="{{ $ad->title }}" class="w-full h-40 object-cover">
            </a>
        @else
            <div class="bg-vnn-gray dark:bg-vnn-dark-light border border-gray-200 dark:border-gray-700 rounded h-40 flex items-center justify-center text-gray-400 dark:text-gray-500 text-sm">{{ $ad->title }}</div>
        @endif
    @elseif(isset($advertisements['sidebar']) && $advertisements['sidebar']->count() > 1)
        @php $ad = $advertisements['sidebar']->skip(1)->random(); @endphp
        @if($ad->script_code)
            {!! $ad->script_code !!}
        @elseif($ad->media_file)
            <a href="{{ $ad->link ?? '#' }}" target="_blank" rel="noopener" class="block overflow-hidden rounded-lg border border-gray-200 dark:border-gray-700">
                @if($ad->media_type === 'video')
                <div class="relative w-full" style="padding-top: 25%;">
                    <video src="{{ asset('storage/' . $ad->media_file) }}" class="absolute inset-0 w-full h-full object-cover" muted playsinline onmouseenter="this.play()" onmouseleave="this.pause();this.currentTime=0;"></video>
                </div>
                @else
                <img src="{{ asset('storage/' . $ad->media_file) }}" alt="{{ $ad->title }}" class="w-full h-40 object-cover">
                @endif
            </a>
        @elseif($ad->image_url)
            <a href="{{ $ad->link ?? '#' }}" target="_blank" rel="noopener" class="block overflow-hidden rounded-lg border border-gray-200 dark:border-gray-700">
                <img src="{{ $ad->image_url }}" alt="{{ $ad->title }}" class="w-full h-40 object-cover">
            </a>
        @else
            <div class="bg-vnn-gray dark:bg-vnn-dark-light border border-gray-200 dark:border-gray-700 rounded h-40 flex items-center justify-center text-gray-400 dark:text-gray-500 text-sm">{{ $ad->title }}</div>
        @endif
    @else
    <div class="bg-vnn-gray dark:bg-vnn-dark-light border border-gray-200 dark:border-gray-700 rounded h-24 flex items-center justify-center text-gray-400 dark:text-gray-500 text-sm">Advertisement</div>
    @endif
</section>
@endsection
