@extends('layouts.frontend')

@section('title', 'Homepage')

@section('content')
{{-- Hero Section --}}
<section class="max-w-7xl mx-auto px-4 py-6">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
        {{-- Main Story --}}
        <div class="lg:col-span-2">
            @if($featured)
            <a href="{{ route('frontend.article', $featured->slug) }}" class="group block relative">
                <div class="aspect-[16/9] bg-vnn-dark rounded overflow-hidden">
                    @if($featured->featured_image)
                    <img src="{{ asset('storage/' . $featured->featured_image) }}" alt="{{ $featured->title }}" class="w-full h-full object-cover">
                    @else
                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-vnn-red/80 to-vnn-dark">
                        <span class="text-white/10 font-extrabold text-7xl font-heading">V</span>
                    </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/30 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-6">
                        @if($featured->is_breaking)
                        <span class="bg-vnn-red text-white text-xs font-bold px-2 py-1 rounded uppercase tracking-wide">Breaking News</span>
                        @endif
                        <h1 class="text-white text-2xl md:text-3xl font-extrabold mt-3 leading-tight group-hover:underline transition-all duration-200 font-heading">{{ $featured->title }}</h1>
                        <p class="text-gray-300 text-sm mt-2 line-clamp-2 font-body">{{ $featured->excerpt }}</p>
                        <div class="flex items-center gap-3 mt-3 text-xs text-gray-400">
                            @if($featured->author)
                            <span>By {{ $featured->author->user->name ?? $featured->author->name }}</span>
                            <span>•</span>
                            @endif
                            <span>{{ $featured->publication_date?->diffForHumans() ?? $featured->created_at->diffForHumans() }}</span>
                            @if($featured->category)
                            <span>•</span>
                            <span class="text-vnn-red font-semibold">{{ $featured->category->name }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </a>
            @else
            <a href="#" class="group block relative">
                <div class="aspect-[16/9] bg-vnn-dark rounded overflow-hidden">
                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-vnn-red/80 to-vnn-dark">
                        <span class="text-white/10 font-extrabold text-7xl font-heading">V</span>
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/30 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-6">
                        <span class="bg-vnn-red text-white text-xs font-bold px-2 py-1 rounded uppercase tracking-wide">Breaking News</span>
                        <h1 class="text-white text-2xl md:text-3xl font-extrabold mt-3 leading-tight group-hover:underline transition-all duration-200 font-heading">President Announces Major Economic Reforms to Stabilize Currency and Boost Foreign Investment</h1>
                        <p class="text-gray-300 text-sm mt-2 line-clamp-2 font-body">In a nationwide address, the President outlined sweeping economic measures including tax reforms, foreign exchange liberalization, and infrastructure spending aimed at restoring investor confidence.</p>
                        <div class="flex items-center gap-3 mt-3 text-xs text-gray-400">
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
        </div>

        {{-- Top News Sidebar --}}
        <div>
            <div class="border-b-2 border-vnn-red pb-2 mb-4">
                <h2 class="text-base font-extrabold text-vnn-dark dark:text-white uppercase tracking-tight font-heading">Trending</h2>
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
                    <div class="w-24 h-20 rounded overflow-hidden shrink-0">
                        <img src="{{ asset('storage/' . $news->featured_image) }}" alt="{{ $news->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                    </div>
                    @else
                    <div class="w-24 h-20 bg-gradient-to-br from-vnn-dark to-slate-800 rounded overflow-hidden shrink-0 flex items-center justify-center">
                        <span class="text-white/15 font-extrabold text-xl">V</span>
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

{{-- Breaking News / Live Updates --}}
<section class="max-w-7xl mx-auto px-4 py-4">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Breaking News --}}
        <div class="lg:col-span-2 bg-vnn-dark rounded-lg overflow-hidden border-l-4 border-vnn-red">
            <div class="bg-vnn-red px-4 py-2 flex items-center gap-2">
                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"/></svg>
                <span class="text-white font-extrabold text-sm uppercase tracking-wider">Breaking News</span>
            </div>
            <div class="divide-y divide-vnn-red/20">
                @forelse($breakingNews as $bn)
                <div class="px-4 py-3 hover:bg-white/5 transition">
                    <div class="flex items-start gap-3">
                        <span class="w-2 h-2 bg-vnn-red rounded-full mt-1.5 shrink-0 animate-pulse"></span>
                        <div>
                            <h4 class="text-white text-sm font-bold leading-snug">{{ $bn->title }}</h4>
                            @if($bn->content)
                            <p class="text-gray-400 text-xs mt-1 line-clamp-2 font-body">{{ $bn->content }}</p>
                            @endif
                            <span class="text-gray-500 text-[10px] mt-1 block font-body">{{ $bn->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>
                @empty
                <div class="px-4 py-6 text-center">
                    <p class="text-gray-400 text-sm font-body">No breaking news at the moment. Stay tuned.</p>
                </div>
                @endforelse
            </div>
        </div>

        {{-- Live Updates --}}
        <div class="bg-vnn-dark rounded-lg overflow-hidden border-l-4 border-vnn-blue">
            <div class="bg-vnn-blue px-4 py-2 flex items-center gap-2">
                <span class="w-2 h-2 bg-red-400 rounded-full animate-pulse"></span>
                <span class="text-white font-extrabold text-sm uppercase tracking-wider">Live Updates</span>
            </div>
            @if($liveUpdates->count())
            <div class="divide-y divide-vnn-blue/20">
                @foreach($liveUpdates as $live)
                <div class="px-4 py-3">
                    @if($live->video_url)
                    <div class="aspect-video bg-black rounded overflow-hidden mb-2">
                        @if($live->video_type === 'youtube')
                        <iframe src="{{ $live->video_url }}" class="w-full h-full" frameborder="0" allowfullscreen></iframe>
                        @elseif($live->video_type === 'facebook')
                        <iframe src="{{ $live->video_url }}" class="w-full h-full" frameborder="0" allowfullscreen></iframe>
                        @else
                        <video src="{{ asset('storage/' . $live->video_file) }}" class="w-full h-full" controls></video>
                        @endif
                    </div>
                    @endif
                    <h4 class="text-white text-sm font-bold leading-snug">{{ $live->title }}</h4>
                    @if($live->description)
                    <p class="text-gray-400 text-xs mt-1 line-clamp-2 font-body">{{ $live->description }}</p>
                    @endif
                </div>
                @endforeach
            </div>
            @else
            <div class="px-4 py-6 text-center">
                <div class="w-16 h-16 bg-vnn-blue/20 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg class="w-8 h-8 text-vnn-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                </div>
                <p class="text-gray-400 text-sm font-body">No live streams right now</p>
                <p class="text-gray-500 text-xs mt-1 font-body">Check back later for live video coverage</p>
            </div>
            @endif
            <div class="px-4 py-2 bg-white/5 text-center">
                <a href="#" class="text-vnn-blue text-xs font-semibold hover:underline">Watch all live videos →</a>
            </div>
        </div>
    </div>
</section>

{{-- Main Content + Sidebar --}}
<section class="max-w-7xl mx-auto px-4 py-6">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Main Column --}}
        <div class="lg:col-span-2 space-y-10">

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
        <aside class="space-y-8">
            {{-- Latest News --}}
            <div>
                <div class="flex items-center gap-3 mb-4 border-b-2 border-vnn-red pb-2">
                    <h3 class="text-base font-extrabold text-vnn-dark dark:text-white uppercase tracking-tight font-heading">Latest</h3>
                    <div class="flex-1"></div>
                </div>
                <div class="space-y-3">
                    @forelse($latest as $item)
                    <a href="{{ route('frontend.article', $item->slug) }}" class="flex gap-3 group {{ !$loop->last ? 'pb-3 border-b border-gray-100 dark:border-gray-800' : '' }}">
                        @if($item->featured_image)
                        <div class="w-16 h-14 rounded overflow-hidden shrink-0">
                            <img src="{{ asset('storage/' . $item->featured_image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover">
                        </div>
                        @else
                        <div class="w-16 h-14 bg-gradient-to-br from-vnn-dark to-slate-800 rounded overflow-hidden shrink-0 flex items-center justify-center">
                            <span class="text-white/15 font-extrabold text-lg">V</span>
                        </div>
                        @endif
                        <div class="flex-1">
                            @if($item->category)
                            <span class="text-vnn-red text-[10px] font-bold uppercase tracking-wide">{{ $item->category->name }}</span>
                            @endif
                            <h4 class="text-sm font-bold leading-snug group-hover:text-vnn-red transition line-clamp-2 font-heading">{{ $item->title }}</h4>
                        </div>
                    </a>
                    @empty
                    @for ($i = 0; $i < 6; $i++)
                    <a href="#" class="flex gap-3 group {{ $i < 5 ? 'pb-3 border-b border-gray-100 dark:border-gray-800' : '' }}">
                        <div class="w-16 h-14 bg-gradient-to-br from-vnn-dark to-slate-800 rounded overflow-hidden shrink-0 flex items-center justify-center">
                            <span class="text-white/15 font-extrabold text-lg">V</span>
                        </div>
                        <div class="flex-1">
                            <span class="text-vnn-red text-[10px] font-bold uppercase tracking-wide">{{ ['Politics', 'Business', 'Tech', 'Sports', 'World', 'Entertainment'][$i] }}</span>
                            <h4 class="text-sm font-bold leading-snug group-hover:text-vnn-red transition line-clamp-2 font-heading">Latest news headline number {{ $i + 1 }} that is breaking now</h4>
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
