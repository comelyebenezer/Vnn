@extends('layouts.frontend')

@section('title', 'Homepage')

@section('content')
{{-- Hero Section --}}
<section class="max-w-7xl mx-auto px-4 py-6">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
        {{-- Main Story --}}
        <div class="lg:col-span-2">
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
        </div>

        {{-- Top News Sidebar --}}
        <div>
            <div class="border-b-2 border-vnn-red pb-2 mb-4">
                <h2 class="text-base font-extrabold text-vnn-dark dark:text-white uppercase tracking-tight font-heading">Top News</h2>
            </div>
            @php
                $topNews = [
                    ['label' => 'Politics', 'headline' => "Obi blasts Lokoja verdict on NDC, warns against capture of state institutions"],
                    ['label' => 'Politics', 'headline' => "Kwara PDP presents Certificates of Return, INEC forms to guber candidate"],
                    ['label' => 'News', 'headline' => "Olukoyas award N6.2m, scholarships to students, reaffirm commitment to youth development"],
                    ['label' => 'Features', 'headline' => "Davido releases first 2026 single, 'I Know Who I Be'"],
                    ['label' => 'Education', 'headline' => "ABSU holds screening of first-class graduates eligible for retainment"],
                ];
            @endphp
            <div class="space-y-3">
                @foreach($topNews as $i => $news)
                <a href="#" class="flex gap-3 group {{ $i < 4 ? 'pb-3 border-b border-gray-100 dark:border-gray-800' : '' }}">
                    <span class="text-lg font-extrabold text-gray-200 dark:text-gray-700 leading-none shrink-0 w-6">{{ $i + 1 }}</span>
                    <div>
                        <span class="text-vnn-red text-[10px] font-bold uppercase tracking-wide">{{ $news['label'] }}</span>
                        <h3 class="text-sm font-bold leading-snug mt-0.5 group-hover:text-vnn-red transition line-clamp-2 font-heading">{{ $news['headline'] }}</h3>
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
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Main Column --}}
        <div class="lg:col-span-2 space-y-10">

            {{-- News Section --}}
            <div>
                <div class="flex items-center gap-3 mb-5 border-b-2 border-vnn-red pb-2">
                    <h2 class="text-lg font-extrabold text-vnn-dark dark:text-white uppercase tracking-tight font-heading">News</h2>
                    <div class="flex-1"></div>
                    <a href="{{ route('frontend.category', 'news') }}" class="text-xs text-vnn-red font-semibold hover:underline">See All →</a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    {{-- Main News --}}
                    <a href="#" class="group md:col-span-2">
                        <div class="aspect-[16/9] bg-gradient-to-br from-vnn-red/60 to-vnn-dark rounded overflow-hidden flex items-center justify-center mb-3">
                            <span class="text-white/15 font-extrabold text-4xl">N</span>
                        </div>
                        <span class="text-vnn-red text-xs font-bold uppercase tracking-wide">News</span>
                        <h3 class="text-lg font-bold leading-snug mt-1 group-hover:text-vnn-red transition font-heading">Xenophobia: South Africa is nothing without Africa - MTN Group chairman</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 line-clamp-2 font-body">The Chairman of MTN Group, Dr. Mcebisi Jonas, has declared that South Africa cannot thrive without the rest of the African continent...</p>
                    </a>
                    {{-- Sub Stories --}}
                    @for ($i = 0; $i < 4; $i++)
                    <a href="#" class="group flex gap-3">
                        <div class="w-20 h-16 bg-gradient-to-br from-vnn-dark to-slate-800 rounded overflow-hidden shrink-0 flex items-center justify-center">
                            <span class="text-white/15 font-extrabold">N</span>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold leading-snug group-hover:text-vnn-red transition line-clamp-2 font-heading">Nigeria news headline {{ $i + 1 }} that covers important developments</h4>
                            <span class="text-xs text-gray-400 dark:text-gray-500">{{ $i + 1 }} hour{{ $i > 0 ? 's' : '' }} ago</span>
                        </div>
                    </a>
                    @endfor
                </div>
            </div>

            {{-- Politics Section --}}
            <div>
                <div class="flex items-center gap-3 mb-5 border-b-2 border-vnn-red pb-2">
                    <h2 class="text-lg font-extrabold text-vnn-dark dark:text-white uppercase tracking-tight font-heading">Politics</h2>
                    <div class="flex-1"></div>
                    <a href="{{ route('frontend.category', 'politics') }}" class="text-xs text-vnn-red font-semibold hover:underline">See All →</a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <a href="#" class="group md:col-span-2">
                        <div class="aspect-[16/9] bg-gradient-to-br from-red-800/60 to-vnn-dark rounded overflow-hidden flex items-center justify-center mb-3">
                            <span class="text-white/15 font-extrabold text-4xl">P</span>
                        </div>
                        <span class="text-vnn-red text-xs font-bold uppercase tracking-wide">Politics</span>
                        <h3 class="text-lg font-bold leading-snug mt-1 group-hover:text-vnn-red transition font-heading">NDC Rejects Court Verdict, Heads to Appeal Over Registration Dispute</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 line-clamp-2 font-body">The National Democratic Congress has rejected the recent court verdict regarding its registration status and has announced plans to appeal the decision...</p>
                    </a>
                    @for ($i = 0; $i < 4; $i++)
                    <a href="#" class="group flex gap-3">
                        <div class="w-20 h-16 bg-gradient-to-br from-red-800 to-red-950 rounded overflow-hidden shrink-0 flex items-center justify-center">
                            <span class="text-white/15 font-extrabold">P</span>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold leading-snug group-hover:text-vnn-red transition line-clamp-2 font-heading">Political headline {{ $i + 1 }} about Nigerian elections and governance</h4>
                            <span class="text-xs text-gray-400 dark:text-gray-500">{{ $i + 2 }} hours ago</span>
                        </div>
                    </a>
                    @endfor
                </div>
            </div>

            {{-- Ad --}}
            <div class="bg-vnn-gray dark:bg-vnn-dark-light border border-gray-200 dark:border-gray-700 rounded h-24 flex items-center justify-center text-gray-400 dark:text-gray-500 text-sm">Advertisement</div>

            {{-- Business Section --}}
            <div>
                <div class="flex items-center gap-3 mb-5 border-b-2 border-vnn-red pb-2">
                    <h2 class="text-lg font-extrabold text-vnn-dark dark:text-white uppercase tracking-tight font-heading">Business</h2>
                    <div class="flex-1"></div>
                    <a href="{{ route('frontend.category', 'business') }}" class="text-xs text-vnn-red font-semibold hover:underline">See All →</a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <a href="#" class="group md:col-span-2">
                        <div class="aspect-[16/9] bg-gradient-to-br from-green-800/60 to-green-950 rounded overflow-hidden flex items-center justify-center mb-3">
                            <span class="text-white/15 font-extrabold text-4xl">B</span>
                        </div>
                        <span class="text-vnn-red text-xs font-bold uppercase tracking-wide">Business</span>
                        <h3 class="text-lg font-bold leading-snug mt-1 group-hover:text-vnn-red transition font-heading">Intra-African trade rises by 5.5% as regional integration gains momentum</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 line-clamp-2 font-body">Trade among African nations has seen a significant boost as the African Continental Free Trade Area (AfCFTA) continues to gain traction...</p>
                    </a>
                    @for ($i = 0; $i < 4; $i++)
                    <a href="#" class="group flex gap-3">
                        <div class="w-20 h-16 bg-gradient-to-br from-green-800 to-green-950 rounded overflow-hidden shrink-0 flex items-center justify-center">
                            <span class="text-white/15 font-extrabold">B</span>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold leading-snug group-hover:text-vnn-red transition line-clamp-2 font-heading">Business headline {{ $i + 1 }} about economy and markets</h4>
                            <span class="text-xs text-gray-400 dark:text-gray-500">{{ $i + 1 }} hour{{ $i > 0 ? 's' : '' }} ago</span>
                        </div>
                    </a>
                    @endfor
                </div>
            </div>

            {{-- Technology Section --}}
            <div>
                <div class="flex items-center gap-3 mb-5 border-b-2 border-vnn-red pb-2">
                    <h2 class="text-lg font-extrabold text-vnn-dark dark:text-white uppercase tracking-tight font-heading">Technology</h2>
                    <div class="flex-1"></div>
                    <a href="{{ route('frontend.category', 'technology') }}" class="text-xs text-vnn-red font-semibold hover:underline">See All →</a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <a href="#" class="group md:col-span-2">
                        <div class="aspect-[16/9] bg-gradient-to-br from-blue-800/60 to-blue-950 rounded overflow-hidden flex items-center justify-center mb-3">
                            <span class="text-white/15 font-extrabold text-4xl">T</span>
                        </div>
                        <span class="text-vnn-red text-xs font-bold uppercase tracking-wide">Technology</span>
                        <h3 class="text-lg font-bold leading-snug mt-1 group-hover:text-vnn-red transition font-heading">Nigeria's Tech Ecosystem Attracts $2.5 Billion in Q1 2026, Led by Fintech and AI Startups</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 line-clamp-2 font-body">Nigeria's technology sector continues to attract significant investment with fintech and artificial intelligence companies leading the charge...</p>
                    </a>
                    @for ($i = 0; $i < 4; $i++)
                    <a href="#" class="group flex gap-3">
                        <div class="w-20 h-16 bg-gradient-to-br from-blue-800 to-blue-950 rounded overflow-hidden shrink-0 flex items-center justify-center">
                            <span class="text-white/15 font-extrabold">T</span>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold leading-snug group-hover:text-vnn-red transition line-clamp-2 font-heading">Tech headline {{ $i + 1 }} about innovation and startups</h4>
                            <span class="text-xs text-gray-400 dark:text-gray-500">{{ $i + 1 }} hour{{ $i > 0 ? 's' : '' }} ago</span>
                        </div>
                    </a>
                    @endfor
                </div>
            </div>

            {{-- Sports Section --}}
            <div>
                <div class="flex items-center gap-3 mb-5 border-b-2 border-vnn-red pb-2">
                    <h2 class="text-lg font-extrabold text-vnn-dark dark:text-white uppercase tracking-tight font-heading">Sports</h2>
                    <div class="flex-1"></div>
                    <a href="{{ route('frontend.category', 'sports') }}" class="text-xs text-vnn-red font-semibold hover:underline">See All →</a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <a href="#" class="group md:col-span-2">
                        <div class="aspect-[16/9] bg-gradient-to-br from-orange-700/60 to-orange-950 rounded overflow-hidden flex items-center justify-center mb-3">
                            <span class="text-white/15 font-extrabold text-4xl">S</span>
                        </div>
                        <span class="text-vnn-red text-xs font-bold uppercase tracking-wide">Sports</span>
                        <h3 class="text-lg font-bold leading-snug mt-1 group-hover:text-vnn-red transition font-heading">Egypt, Iran face crunch World Cup game in shadow of geopolitics</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 line-clamp-2 font-body">Egypt and Iran face a crucial World Cup group stage match with geopolitical tensions adding to the drama of the tournament...</p>
                    </a>
                    @for ($i = 0; $i < 4; $i++)
                    <a href="#" class="group flex gap-3">
                        <div class="w-20 h-16 bg-gradient-to-br from-orange-700 to-orange-900 rounded overflow-hidden shrink-0 flex items-center justify-center">
                            <span class="text-white/15 font-extrabold">S</span>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold leading-snug group-hover:text-vnn-red transition line-clamp-2 font-heading">Sports headline {{ $i + 1 }} about football and athletics</h4>
                            <span class="text-xs text-gray-400 dark:text-gray-500">{{ $i + 1 }} hour{{ $i > 0 ? 's' : '' }} ago</span>
                        </div>
                    </a>
                    @endfor
                </div>
            </div>

            {{-- Entertainment Section --}}
            <div>
                <div class="flex items-center gap-3 mb-5 border-b-2 border-vnn-red pb-2">
                    <h2 class="text-lg font-extrabold text-vnn-dark dark:text-white uppercase tracking-tight font-heading">Entertainment</h2>
                    <div class="flex-1"></div>
                    <a href="{{ route('frontend.category', 'entertainment') }}" class="text-xs text-vnn-red font-semibold hover:underline">See All →</a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <a href="#" class="group md:col-span-2">
                        <div class="aspect-[16/9] bg-gradient-to-br from-purple-800/60 to-purple-950 rounded overflow-hidden flex items-center justify-center mb-3">
                            <span class="text-white/15 font-extrabold text-4xl">E</span>
                        </div>
                        <span class="text-vnn-red text-xs font-bold uppercase tracking-wide">Entertainment</span>
                        <h3 class="text-lg font-bold leading-snug mt-1 group-hover:text-vnn-red transition font-heading">Davido releases first 2026 single, 'I Know Who I Be'</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 line-clamp-2 font-body">Nigerian Afrobeats star David Adeleke, popularly known as Davido, has kicked off 2026 with the release of his new single...</p>
                    </a>
                    @for ($i = 0; $i < 4; $i++)
                    <a href="#" class="group flex gap-3">
                        <div class="w-20 h-16 bg-gradient-to-br from-purple-800 to-purple-950 rounded overflow-hidden shrink-0 flex items-center justify-center">
                            <span class="text-white/15 font-extrabold">E</span>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold leading-snug group-hover:text-vnn-red transition line-clamp-2 font-heading">Entertainment headline {{ $i + 1 }} about music and film</h4>
                            <span class="text-xs text-gray-400 dark:text-gray-500">{{ $i + 1 }} hour{{ $i > 0 ? 's' : '' }} ago</span>
                        </div>
                    </a>
                    @endfor
                </div>
            </div>

            {{-- World Section --}}
            <div>
                <div class="flex items-center gap-3 mb-5 border-b-2 border-vnn-red pb-2">
                    <h2 class="text-lg font-extrabold text-vnn-dark dark:text-white uppercase tracking-tight font-heading">World</h2>
                    <div class="flex-1"></div>
                    <a href="{{ route('frontend.category', 'world') }}" class="text-xs text-vnn-red font-semibold hover:underline">See All →</a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <a href="#" class="group md:col-span-2">
                        <div class="aspect-[16/9] bg-gradient-to-br from-slate-700/60 to-slate-950 rounded overflow-hidden flex items-center justify-center mb-3">
                            <span class="text-white/15 font-extrabold text-4xl">W</span>
                        </div>
                        <span class="text-vnn-red text-xs font-bold uppercase tracking-wide">World</span>
                        <h3 class="text-lg font-bold leading-snug mt-1 group-hover:text-vnn-red transition font-heading">Global Leaders Convene at UN Climate Summit: Historic Agreement Reached on Carbon Emissions</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 line-clamp-2 font-body">World leaders have reached a historic agreement at the United Nations Climate Summit, pledging to reduce carbon emissions...</p>
                    </a>
                    @for ($i = 0; $i < 4; $i++)
                    <a href="#" class="group flex gap-3">
                        <div class="w-20 h-16 bg-gradient-to-br from-slate-700 to-slate-900 rounded overflow-hidden shrink-0 flex items-center justify-center">
                            <span class="text-white/15 font-extrabold">W</span>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold leading-snug group-hover:text-vnn-red transition line-clamp-2 font-heading">World headline {{ $i + 1 }} about international affairs</h4>
                            <span class="text-xs text-gray-400 dark:text-gray-500">{{ $i + 1 }} hour{{ $i > 0 ? 's' : '' }} ago</span>
                        </div>
                    </a>
                    @endfor
                </div>
            </div>

            {{-- Opinion & Editorial --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <div class="flex items-center gap-3 mb-4 border-b-2 border-vnn-red pb-2">
                        <h2 class="text-lg font-extrabold text-vnn-dark dark:text-white uppercase tracking-tight font-heading">Opinion</h2>
                        <div class="flex-1"></div>
                        <a href="#" class="text-xs text-vnn-red font-semibold hover:underline">See All →</a>
                    </div>
                    <div class="space-y-4">
                        @for ($i = 0; $i < 3; $i++)
                        <div class="bg-white dark:bg-vnn-dark-light p-4 rounded shadow-sm border-l-4 border-vnn-red">
                            <h3 class="text-sm font-bold leading-snug font-heading"><a href="#" class="hover:text-vnn-red transition">Thought-Provoking Opinion Piece on Nigeria's Political Landscape and Democratic Future</a></h3>
                            <div class="flex items-center gap-2 mt-2 text-xs text-gray-400">
                                <span>By Dr. Amina Bello</span>
                                <span>•</span>
                                <span>June {{ 23 - $i }}, 2026</span>
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>
                <div>
                    <div class="flex items-center gap-3 mb-4 border-b-2 border-vnn-red pb-2">
                        <h2 class="text-lg font-extrabold text-vnn-dark dark:text-white uppercase tracking-tight font-heading">Editorial</h2>
                        <div class="flex-1"></div>
                        <a href="#" class="text-xs text-vnn-red font-semibold hover:underline">See All →</a>
                    </div>
                    <div class="space-y-4">
                        @for ($i = 0; $i < 3; $i++)
                        <div class="bg-white dark:bg-vnn-dark-light p-4 rounded shadow-sm border-l-4 border-vnn-red">
                            <h3 class="text-sm font-bold leading-snug font-heading"><a href="#" class="hover:text-vnn-red transition">The renewed Lagos monthly sanitation exercise: Matters arising</a></h3>
                            <div class="flex items-center gap-2 mt-2 text-xs text-gray-400">
                                <span>June {{ 26 - $i }}, 2026</span>
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>
            </div>

            {{-- Video Section --}}
            <div>
                <div class="flex items-center gap-3 mb-5 border-b-2 border-vnn-red pb-2">
                    <h2 class="text-lg font-extrabold text-vnn-dark dark:text-white uppercase tracking-tight font-heading">Video</h2>
                    <div class="flex-1"></div>
                    <a href="#" class="text-xs text-vnn-red font-semibold hover:underline">See All →</a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
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
                </div>
            </div>

            {{-- Podcast Section --}}
            <div>
                <div class="flex items-center gap-3 mb-5 border-b-2 border-vnn-red pb-2">
                    <h2 class="text-lg font-extrabold text-vnn-dark dark:text-white uppercase tracking-tight font-heading">Podcasts</h2>
                    <div class="flex-1"></div>
                    <a href="#" class="text-xs text-vnn-red font-semibold hover:underline">See All →</a>
                </div>
                <div class="space-y-3">
                    @for ($i = 0; $i < 3; $i++)
                    <a href="#" class="flex items-center gap-4 p-3 bg-white dark:bg-vnn-dark-light rounded shadow-sm hover:bg-vnn-gray dark:hover:bg-vnn-dark transition group hover:-translate-y-0.5 duration-200">
                        <div class="w-14 h-14 bg-vnn-red rounded flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M18 3a1 1 0 00-1.196-.98l-10 2A1 1 0 006 5v9.114A4.369 4.369 0 005 14c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V7.82l8-1.6v5.894A4.37 4.37 0 0015 12c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V3z"/></svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-sm font-bold group-hover:text-vnn-red transition font-heading">VNN Daily Podcast: Episode {{ $i + 100 }} — Today's Top Stories and Expert Interviews</h3>
                            <span class="text-xs text-gray-400 dark:text-gray-500 font-body">45 min • Season {{ $i + 1 }}, Ep {{ $i + 100 }}</span>
                        </div>
                        <span class="text-xs text-vnn-red font-semibold group-hover:translate-x-0.5 transition-transform">Play →</span>
                    </a>
                    @endfor
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
                    @for ($i = 0; $i < 5; $i++)
                    <a href="#" class="flex gap-3 group">
                        <span class="text-2xl font-extrabold text-gray-200 dark:text-gray-700 leading-none shrink-0 w-8">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                        <div>
                            <h4 class="text-sm font-bold leading-snug group-hover:text-vnn-red transition line-clamp-2 font-heading">Most read story number {{ $i + 1 }} that everyone is talking about</h4>
                            <span class="text-xs text-gray-400 dark:text-gray-500 font-body">{{ rand(1000, 50000) }} views</span>
                        </div>
                    </a>
                    @endfor
                </div>
            </div>

            {{-- Newsletter --}}
            <div class="bg-vnn-dark rounded-lg p-6 text-white">
                <h3 class="font-extrabold text-lg font-heading">Stay Informed</h3>
                <p class="text-sm text-gray-300 mt-1 font-body">Get the latest news delivered to your inbox every morning.</p>
                <form class="mt-4" @submit.prevent="alert('Newsletter subscription coming soon!')">
                    <input type="email" placeholder="Enter your email" class="w-full px-4 py-2.5 rounded text-sm text-gray-900 mb-2 focus:outline-none focus:ring-2 focus:ring-vnn-red font-body" required>
                    <button class="w-full bg-vnn-red text-white font-bold py-2.5 rounded text-sm hover:bg-vnn-red-dark transition active:scale-[0.98] font-heading">Subscribe Now</button>
                </form>
                <p class="text-xs text-gray-400 mt-2">No spam. Unsubscribe anytime.</p>
            </div>

            {{-- Gallery --}}
            <div>
                <div class="flex items-center gap-3 mb-4 border-b-2 border-vnn-red pb-2">
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
                    <a href="#" class="bg-vnn-gray dark:bg-vnn-dark-light text-gray-600 dark:text-gray-300 text-xs font-medium px-3 py-1.5 rounded hover:bg-vnn-red hover:text-white transition active:scale-95">{{ $tag }}</a>
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