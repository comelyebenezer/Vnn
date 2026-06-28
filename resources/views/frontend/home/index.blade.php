@extends('layouts.frontend')

@section('title', 'Homepage')

@section('content')
{{-- Hero Section --}}
<section class="max-w-7xl mx-auto px-4 py-4">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-4">
        {{-- Breaking News --}}
        <div class="lg:col-span-5">
            <div class="border-b border-vnn-red pb-1.5 mb-2">
                <h2 class="text-sm font-extrabold text-vnn-dark dark:text-white uppercase tracking-tight font-heading">Breaking News</h2>
            </div>
            {{-- Featured breaking story --}}
            @php $story = $featured; @endphp
            @if($story)
            <a href="{{ route('frontend.article', $story->slug) }}" class="group block relative mb-2">
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
                            @if($story->author)
                            <span>By {{ $story->author->user->name ?? $story->author->name }}</span>
                            <span>•</span>
                            @endif
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
            <a href="#" class="group block relative mb-2">
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
            <div class="divide-y divide-gray-100 dark:divide-gray-800">
                @forelse($breakingNews as $bn)
                <div class="flex items-start gap-2 py-2 pr-1">
                    <span class="w-1.5 h-1.5 bg-vnn-red rounded-full mt-1.5 shrink-0 animate-pulse"></span>
                    <div>
                        <h4 class="text-xs font-bold leading-snug text-vnn-dark dark:text-white font-heading">{{ $bn->title }}</h4>
                        <span class="text-[10px] text-gray-400 font-body">{{ $bn->created_at->diffForHumans() }}</span>
                    </div>
                </div>
                @empty
                @if(!$story)
                <p class="text-gray-400 text-xs font-body py-3 text-center">No breaking news at the moment.</p>
                @endif
                @endforelse
            </div>

            {{-- Trending Videos --}}
            <div class="mt-4 pt-3 border-t border-vnn-red/30">
                <div class="flex items-center justify-between mb-2">
                    <h2 class="text-sm font-extrabold text-vnn-dark dark:text-white uppercase tracking-tight font-heading flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 text-vnn-red" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M9.383 3.076A1 1 0 0110 4v12a1 1 0 01-1.707.707L4.586 13H2a1 1 0 01-1-1V8a1 1 0 011-1h2.586l3.707-3.707a1 1 0 011.09-.217zM14.657 2.929a1 1 0 011.414 0A9.972 9.972 0 0119 10a9.972 9.972 0 01-2.929 7.071 1 1 0 01-1.414-1.414A7.971 7.971 0 0017 10c0-2.21-.894-4.208-2.343-5.657a1 1 0 010-1.414zm-2.829 2.828a1 1 0 011.415 0A5.983 5.983 0 0115 10a5.984 5.984 0 01-1.757 4.243 1 1 0 01-1.415-1.415A3.984 3.984 0 0013 10a3.983 3.983 0 00-1.172-2.828 1 1 0 010-1.415z" clip-rule="evenodd"/></svg>
                        Top Videos
                    </h2>
                    <a href="{{ route('frontend.video') }}" class="text-[10px] text-vnn-blue font-semibold hover:underline">View All →</a>
                </div>
                <div class="grid grid-cols-2 gap-2">
                    @forelse($trendingVideos as $tv)
                    <div class="bg-vnn-dark rounded overflow-hidden">
                        @if($tv->video_url)
                        <div class="aspect-video bg-black">
                            @if($tv->video_type === 'youtube')
                            <iframe src="{{ $tv->video_url }}" class="w-full h-full" frameborder="0" allowfullscreen></iframe>
                            @elseif($tv->video_type === 'facebook')
                            <iframe src="{{ $tv->video_url }}" class="w-full h-full" frameborder="0" allowfullscreen></iframe>
                            @else
                            <video src="{{ asset('storage/' . $tv->video_file) }}" class="w-full h-full" controls></video>
                            @endif
                        </div>
                        @endif
                        <div class="p-2">
                            <h4 class="text-white text-[11px] font-bold leading-snug">{{ $tv->title }}</h4>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-2 flex flex-col items-center justify-center py-4 text-center">
                        <div class="w-10 h-10 bg-vnn-blue/20 rounded-full flex items-center justify-center mb-1.5">
                            <svg class="w-5 h-5 text-vnn-blue" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M9.383 3.076A1 1 0 0110 4v12a1 1 0 01-1.707.707L4.586 13H2a1 1 0 01-1-1V8a1 1 0 011-1h2.586l3.707-3.707a1 1 0 011.09-.217z" clip-rule="evenodd"/></svg>
                        </div>
                        <p class="text-xs text-gray-400 font-body">No trending videos yet</p>
                    </div>
                    @endforelse
                </div>
            </div>
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
                <div class="bg-vnn-dark rounded overflow-hidden border-l-4 border-vnn-blue">
                    @if($live->video_url)
                    <div class="aspect-video bg-black relative">
                        @if($live->video_type === 'youtube')
                        <iframe src="{{ $live->video_url }}" class="w-full h-full" frameborder="0" allowfullscreen></iframe>
                        @elseif($live->video_type === 'facebook')
                        <iframe src="{{ $live->video_url }}" class="w-full h-full" frameborder="0" allowfullscreen></iframe>
                        @else
                        <video src="{{ asset('storage/' . $live->video_file) }}" class="w-full h-full" controls></video>
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
                        <p class="text-gray-400 text-[11px] mt-1 line-clamp-2 font-body">{{ $live->description }}</p>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="bg-vnn-dark rounded p-3 text-center border-l-4 border-vnn-blue">
                <div class="w-10 h-10 bg-vnn-blue/20 rounded-full flex items-center justify-center mx-auto mb-1.5">
                    <svg class="w-5 h-5 text-vnn-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                </div>
                <p class="text-gray-400 text-xs font-body">No live streams right now</p>
            </div>
            @endif
        </div>

        {{-- Trending --}}
        <div class="lg:col-span-3">
            <div class="border-b border-vnn-red pb-1.5 mb-2">
                <h2 class="text-sm font-extrabold text-vnn-dark dark:text-white uppercase tracking-tight font-heading">Trending</h2>
            </div>
            @php
                $topItems = $topNews->isNotEmpty() ? $topNews : collect([
                    (object)['id' => 0, 'slug' => '#', 'title' => "Obi blasts Lokoja verdict on NDC, warns against capture of state institutions", 'category' => (object)['slug' => 'politics', 'name' => 'Politics']],
                    (object)['id' => 1, 'slug' => '#', 'title' => "Kwara PDP presents Certificates of Return, INEC forms to guber candidate", 'category' => (object)['slug' => 'politics', 'name' => 'Politics']],
                    (object)['id' => 2, 'slug' => '#', 'title' => "Olukoyas award N6.2m, scholarships to students, reaffirm commitment to youth development", 'category' => (object)['slug' => 'news', 'name' => 'News']],
                    (object)['id' => 3, 'slug' => '#', 'title' => "Davido releases first 2026 single, 'I Know Who I Be'", 'category' => (object)['slug' => 'entertainment', 'name' => 'Entertainment']],
                    (object)['id' => 4, 'slug' => '#', 'title' => "ABSU holds screening of first-class graduates eligible for retainment", 'category' => (object)['slug' => 'education', 'name' => 'Education']],
                ]);
            @endphp
            <div class="space-y-3">
                @foreach($topItems as $i => $news)
                <a href="{{ $news->slug !== '#' ? route('frontend.article', $news->slug) : '#' }}" class="flex gap-3 group {{ $i < $topItems->count() - 1 ? 'pb-3 border-b border-gray-100 dark:border-gray-800' : '' }}">
                    <span class="text-lg font-extrabold text-gray-200 dark:text-gray-700 leading-none shrink-0 w-6">{{ $i + 1 }}</span>
                    @if(isset($news->featured_image) && $news->featured_image)
                    <div class="w-32 h-24 rounded overflow-hidden shrink-0">
                        <img src="{{ asset('storage/' . $news->featured_image) }}" alt="{{ $news->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                    </div>
                    @else
                    <div class="w-32 h-24 bg-gradient-to-br from-vnn-dark to-slate-800 rounded overflow-hidden shrink-0 flex items-center justify-center">
                        <span class="text-white/15 font-extrabold text-2xl">V</span>
                    </div>
                    @endif
                    <div class="flex-1 min-w-0">
                        @if(isset($news->category) && $news->category)
                        <span class="text-vnn-red text-[10px] font-bold uppercase tracking-wide">{{ $news->category->name }}</span>
                        @endif
                        <h3 class="text-sm font-bold leading-snug mt-0.5 group-hover:text-vnn-red transition line-clamp-2 font-heading">{{ $news->title }}</h3>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- Ad Banner --}}
<section class="max-w-7xl mx-auto px-4 py-3">
    <div class="bg-vnn-gray dark:bg-vnn-dark-light border border-gray-200 dark:border-gray-700 rounded h-24 flex items-center justify-center text-gray-400 dark:text-gray-500 text-sm">Advertisement</div>
</section>

{{-- Main Content + Sidebar --}}
<section class="max-w-7xl mx-auto px-4 py-6">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        {{-- Main Column --}}
        <div class="lg:col-span-7 space-y-10">

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
                            <h3 class="text-lg font-bold leading-snug mt-1 group-hover:text-vnn-red transition font-heading">{{ $sec['main']->title }}</h3>
                            @if($sec['main']->excerpt)
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 line-clamp-2 font-body">{{ $sec['main']->excerpt }}</p>
                            @endif
                        </a>
                        @forelse($sec['subs'] as $sub)
                        <a href="{{ route('frontend.article', $sub->slug) }}" class="group flex gap-3">
                            @if($sub->featured_image)
                            <div class="w-20 h-16 rounded overflow-hidden shrink-0">
                                <img src="{{ asset('storage/' . $sub->featured_image) }}" alt="{{ $sub->title }}" class="w-full h-full object-cover">
                            </div>
                            @else
                            <div class="w-20 h-16 bg-gradient-to-br from-vnn-dark to-slate-800 rounded overflow-hidden shrink-0 flex items-center justify-center">
                                <span class="text-white/15 font-extrabold">{{ substr($sec['category']->name, 0, 1) }}</span>
                            </div>
                            @endif
                            <div>
                                <h4 class="text-sm font-bold leading-snug group-hover:text-vnn-red transition line-clamp-2 font-heading">{{ $sub->title }}</h4>
                                <span class="text-xs text-gray-400 dark:text-gray-500">{{ $sub->publication_date?->diffForHumans() ?? $sub->created_at->diffForHumans() }}</span>
                            </div>
                        </a>
                        @empty
                        @for ($i = 0; $i < 4; $i++)
                        <a href="#" class="group flex gap-3">
                            <div class="w-20 h-16 bg-gradient-to-br from-vnn-dark to-slate-800 rounded overflow-hidden shrink-0 flex items-center justify-center">
                                <span class="text-white/15 font-extrabold">{{ substr($sec['category']->name, 0, 1) }}</span>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold leading-snug group-hover:text-vnn-red transition line-clamp-2 font-heading">{{ $sec['category']->name }} headline {{ $i + 1 }} that covers important developments</h4>
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
                            <h3 class="text-lg font-bold leading-snug mt-1 group-hover:text-vnn-red transition font-heading">Latest {{ ucfirst($slug) }} stories and updates from Verve News Network</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 line-clamp-2 font-body">Stay informed with the latest {{ $slug }} news, analysis, and in-depth reporting from our team of journalists.</p>
                        </a>
                        @for ($i = 0; $i < 4; $i++)
                        <a href="#" class="group flex gap-3">
                            <div class="w-20 h-16 bg-gradient-to-br from-vnn-dark to-slate-800 rounded overflow-hidden shrink-0 flex items-center justify-center">
                                <span class="text-white/15 font-extrabold">{{ strtoupper(substr($slug, 0, 1)) }}</span>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold leading-snug group-hover:text-vnn-red transition line-clamp-2 font-heading">{{ ucfirst($slug) }} headline {{ $i + 1 }} that covers important developments</h4>
                                <span class="text-xs text-gray-400 dark:text-gray-500">{{ $i + 1 }} hour{{ $i > 0 ? 's' : '' }} ago</span>
                            </div>
                        </a>
                        @endfor
                    </div>
                </div>
                @endif
            @endforeach

            {{-- Ad --}}
            <div class="bg-vnn-gray dark:bg-vnn-dark-light border border-gray-200 dark:border-gray-700 rounded h-24 flex items-center justify-center text-gray-400 dark:text-gray-500 text-sm">Advertisement</div>

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
                            <h3 class="text-sm font-bold leading-snug font-heading"><a href="{{ route('frontend.article', $opinion->slug) }}" class="hover:text-vnn-red transition">{{ $opinion->title }}</a></h3>
                            <div class="flex items-center gap-2 mt-2 text-xs text-gray-400">
                                @if($opinion->author)
                                <span>By {{ $opinion->author->user->name ?? $opinion->author->name }}</span>
                                <span>•</span>
                                @endif
                                <span>{{ $opinion->publication_date?->format('F j, Y') ?? $opinion->created_at->format('F j, Y') }}</span>
                            </div>
                        </div>
                        @empty
                        @for ($i = 0; $i < 3; $i++)
                        <div class="bg-white dark:bg-vnn-dark-light p-4 rounded shadow-sm border-l-4 border-vnn-blue">
                            <h3 class="text-sm font-bold leading-snug font-heading"><a href="#" class="hover:text-vnn-red transition">Thought-Provoking Opinion Piece on Nigeria's Political Landscape and Democratic Future</a></h3>
                            <div class="flex items-center gap-2 mt-2 text-xs text-gray-400">
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
                            <h3 class="text-sm font-bold leading-snug font-heading"><a href="{{ route('frontend.article', $editorial->slug) }}" class="hover:text-vnn-red transition">{{ $editorial->title }}</a></h3>
                            <div class="flex items-center gap-2 mt-2 text-xs text-gray-400">
                                <span>{{ $editorial->publication_date?->format('F j, Y') ?? $editorial->created_at->format('F j, Y') }}</span>
                            </div>
                        </div>
                        @empty
                        @for ($i = 0; $i < 3; $i++)
                        <div class="bg-white dark:bg-vnn-dark-light p-4 rounded shadow-sm border-l-4 border-vnn-red">
                            <h3 class="text-sm font-bold leading-snug font-heading"><a href="#" class="hover:text-vnn-red transition">The renewed Lagos monthly sanitation exercise: Matters arising</a></h3>
                            <div class="flex items-center gap-2 mt-2 text-xs text-gray-400">
                                <span>June {{ 26 - $i }}, 2026</span>
                            </div>
                        </div>
                        @endfor
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- Video Section --}}
            <div>
                <div class="flex items-center gap-3 mb-5 border-b-2 border-vnn-blue pb-2">
                    <h2 class="text-lg font-extrabold text-vnn-dark dark:text-white uppercase tracking-tight font-heading">Video</h2>
                    <div class="flex-1"></div>
                    <a href="{{ route('frontend.video') }}" class="text-xs text-vnn-red font-semibold hover:underline">See All →</a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @forelse($videos as $video)
                    <a href="{{ route('frontend.article', $video->slug) }}" class="group block hover:-translate-y-1 transition-all duration-200">
                        @if($video->featured_image)
                        <div class="aspect-video rounded overflow-hidden relative mb-3">
                            <img src="{{ asset('storage/' . $video->featured_image) }}" alt="{{ $video->title }}" class="w-full h-full object-cover">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="w-12 h-12 bg-vnn-blue/90 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform duration-200">
                                    <svg class="w-5 h-5 text-white ml-0.5" fill="currentColor" viewBox="0 0 20 20"><path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/></svg>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="aspect-video bg-gradient-to-br from-vnn-blue to-vnn-blue-dark rounded overflow-hidden relative flex items-center justify-center mb-3">
                            <span class="text-white/15 font-extrabold text-3xl">V</span>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="w-12 h-12 bg-vnn-blue/90 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform duration-200">
                                    <svg class="w-5 h-5 text-white ml-0.5" fill="currentColor" viewBox="0 0 20 20"><path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/></svg>
                                </div>
                            </div>
                        </div>
                        @endif
                        <h3 class="text-sm font-bold mt-2 leading-snug group-hover:text-vnn-red transition line-clamp-2 font-heading">{{ $video->title }}</h3>
                        <span class="text-xs text-gray-400 dark:text-gray-500 font-body">{{ $video->publication_date?->diffForHumans() ?? $video->created_at->diffForHumans() }}</span>
                    </a>
                    @empty
                    @for ($i = 0; $i < 3; $i++)
                    <a href="#" class="group block hover:-translate-y-1 transition-all duration-200">
                        <div class="aspect-video bg-gradient-to-br {{ $i === 0 ? 'from-vnn-red to-vnn-red-dark' : ($i === 1 ? 'from-vnn-dark to-slate-800' : 'from-slate-800 to-slate-950') }} rounded overflow-hidden relative flex items-center justify-center">
                            <span class="text-white/15 font-extrabold text-3xl">V</span>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="w-12 h-12 bg-vnn-red/90 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform duration-200">
                                    <svg class="w-5 h-5 text-white ml-0.5" fill="currentColor" viewBox="0 0 20 20"><path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/></svg>
                                </div>
                            </div>
                        </div>
                        <h3 class="text-sm font-bold mt-2 leading-snug group-hover:text-vnn-red transition line-clamp-2 font-heading">Video Title: Coverage of Major News Event and Expert Analysis</h3>
                        <span class="text-xs text-gray-400 dark:text-gray-500 font-body">12:34 • 2 hours ago</span>
                    </a>
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
                    <a href="{{ route('frontend.article', $podcast->slug) }}" class="flex items-center gap-3 md:gap-4 p-3 bg-white dark:bg-vnn-dark-light rounded shadow-sm hover:bg-vnn-gray dark:hover:bg-vnn-dark transition group hover:-translate-y-0.5 duration-200">
                        <div class="w-10 h-10 md:w-14 md:h-14 bg-vnn-blue rounded flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform">
                            <svg class="w-5 h-5 md:w-6 md:h-6 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M18 3a1 1 0 00-1.196-.98l-10 2A1 1 0 006 5v9.114A4.369 4.369 0 005 14c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V7.82l8-1.6v5.894A4.37 4.37 0 0015 12c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V3z"/></svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="text-sm font-bold group-hover:text-vnn-red transition font-heading truncate">{{ $podcast->title }}</h3>
                            <span class="text-xs text-gray-400 dark:text-gray-500 font-body">{{ $podcast->publication_date?->diffForHumans() ?? $podcast->created_at->diffForHumans() }}</span>
                        </div>
                        <span class="hidden sm:inline text-xs text-vnn-blue font-semibold group-hover:translate-x-0.5 transition-transform">Play →</span>
                    </a>
                    @empty
                    @for ($i = 0; $i < 3; $i++)
                    <a href="#" class="flex items-center gap-3 md:gap-4 p-3 bg-white dark:bg-vnn-dark-light rounded shadow-sm hover:bg-vnn-gray dark:hover:bg-vnn-dark transition group hover:-translate-y-0.5 duration-200">
                        <div class="w-10 h-10 md:w-14 md:h-14 bg-vnn-blue rounded flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform">
                            <svg class="w-5 h-5 md:w-6 md:h-6 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M18 3a1 1 0 00-1.196-.98l-10 2A1 1 0 006 5v9.114A4.369 4.369 0 005 14c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V7.82l8-1.6v5.894A4.37 4.37 0 0015 12c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V3z"/></svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="text-sm font-bold group-hover:text-vnn-red transition font-heading truncate">VNN Daily Podcast: Episode {{ $i + 100 }} — Today's Top Stories and Expert Interviews</h3>
                            <span class="text-xs text-gray-400 dark:text-gray-500 font-body">45 min • Season {{ $i + 1 }}, Ep {{ $i + 100 }}</span>
                        </div>
                        <span class="hidden sm:inline text-xs text-vnn-blue font-semibold group-hover:translate-x-0.5 transition-transform">Play →</span>
                    </a>
                    @endfor
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Sidebar --}}
        <aside class="lg:col-span-5 space-y-8">
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
                        <div class="w-40 h-28 rounded overflow-hidden shrink-0">
                            <img src="{{ asset('storage/' . $item->featured_image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                        </div>
                        @else
                        <div class="w-40 h-28 bg-gradient-to-br from-vnn-dark to-slate-800 rounded overflow-hidden shrink-0 flex items-center justify-center">
                            <span class="text-white/15 font-extrabold text-2xl">V</span>
                        </div>
                        @endif
                        <div class="flex-1 min-w-0">
                            @if($item->category)
                            <span class="text-vnn-red text-[10px] font-bold uppercase tracking-wide">{{ $item->category->name }}</span>
                            @endif
                            <h4 class="text-sm font-bold leading-snug mt-0.5 group-hover:text-vnn-red transition line-clamp-3 font-heading">{{ $item->title }}</h4>
                        </div>
                    </a>
                    @empty
                    @for ($i = 0; $i < 6; $i++)
                    <a href="#" class="flex gap-4 group {{ $i < 5 ? 'pb-4 border-b border-gray-100 dark:border-gray-800' : '' }}">
                        <div class="w-40 h-28 bg-gradient-to-br from-vnn-dark to-slate-800 rounded overflow-hidden shrink-0 flex items-center justify-center">
                            <span class="text-white/15 font-extrabold text-2xl">V</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <span class="text-vnn-red text-[10px] font-bold uppercase tracking-wide">{{ ['Politics', 'Business', 'Tech', 'Sports', 'World', 'Entertainment'][$i] }}</span>
                            <h4 class="text-sm font-bold leading-snug mt-0.5 group-hover:text-vnn-red transition line-clamp-3 font-heading">Latest news headline number {{ $i + 1 }} that is breaking now</h4>
                        </div>
                    </a>
                    @endfor
                    @endforelse
                </div>
            </div>

            {{-- Ad --}}
            <div class="bg-vnn-gray dark:bg-vnn-dark-light border border-gray-200 dark:border-gray-700 rounded h-64 flex items-center justify-center text-gray-400 dark:text-gray-500 text-sm">Advertisement</div>

            {{-- Most Read --}}
            <div>
                <div class="flex items-center gap-3 mb-4 border-b-2 border-vnn-red pb-2">
                    <h3 class="text-base font-extrabold text-vnn-dark dark:text-white uppercase tracking-tight font-heading">Most Read</h3>
                    <div class="flex-1"></div>
                </div>
                <div class="space-y-4">
                    @forelse($mostRead as $item)
                    <a href="{{ route('frontend.article', $item->slug) }}" class="flex gap-3 group">
                        <span class="text-2xl font-extrabold text-gray-200 dark:text-gray-700 leading-none shrink-0 w-8">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        <div>
                            <h4 class="text-sm font-bold leading-snug group-hover:text-vnn-red transition line-clamp-2 font-heading">{{ $item->title }}</h4>
                            <span class="text-xs text-gray-400 dark:text-gray-500 font-body">{{ number_format($item->view_count ?? 0) }} views</span>
                        </div>
                    </a>
                    @empty
                    @for ($i = 0; $i < 5; $i++)
                    <a href="#" class="flex gap-3 group">
                        <span class="text-2xl font-extrabold text-gray-200 dark:text-gray-700 leading-none shrink-0 w-8">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                        <div>
                            <h4 class="text-sm font-bold leading-snug group-hover:text-vnn-red transition line-clamp-2 font-heading">Most read story number {{ $i + 1 }} that everyone is talking about</h4>
                            <span class="text-xs text-gray-400 dark:text-gray-500 font-body">{{ rand(1000, 50000) }} views</span>
                        </div>
                    </a>
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
                <div class="grid grid-cols-2 gap-2">
                    @for ($i = 0; $i < 4; $i++)
                    <a href="#" class="aspect-square bg-gradient-to-br {{ $i % 2 ? 'from-vnn-red to-vnn-red-dark' : 'from-vnn-dark to-slate-800' }} rounded overflow-hidden flex items-center justify-center group">
                        <span class="text-white/20 font-extrabold text-2xl group-hover:scale-125 transition-transform duration-500">V</span>
                    </a>
                    @endfor
                </div>
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
<section class="max-w-7xl mx-auto px-4 py-6">
    <div class="bg-vnn-gray dark:bg-vnn-dark-light border border-gray-200 dark:border-gray-700 rounded h-24 flex items-center justify-center text-gray-400 dark:text-gray-500 text-sm">Advertisement</div>
</section>
@endsection
