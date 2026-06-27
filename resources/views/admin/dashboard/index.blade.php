<div>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl font-extrabold text-gray-900 dark:text-white">Dashboard</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">Welcome back, {{ auth()->user()->name }}!</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.articles.create') }}" class="flex items-center gap-2 bg-vnn-red text-white text-sm font-bold px-4 py-2.5 rounded-lg hover:bg-vnn-red-dark transition shadow-lg shadow-vnn-red/20">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    New Article
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6 px-4 lg:px-6">
        <div class="max-w-7xl mx-auto">
            {{-- Flash Message --}}
            @if(session('message'))
            <div class="bg-green-50 dark:bg-green-900/30 border-l-4 border-green-500 text-green-700 dark:text-green-300 p-4 mb-6 rounded-r-lg text-sm flex items-center gap-3">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ session('message') }}
            </div>
            @endif

            {{-- Stats Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
                @php
                    $stats = [
                        ['label' => 'Total Articles', 'value' => number_format($totalArticles), 'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>', 'color' => 'from-vnn-red to-vnn-red-dark', 'bg' => 'bg-red-50 dark:bg-red-900/20'],
                        ['label' => 'Published', 'value' => number_format($publishedArticles), 'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>', 'color' => 'from-green-600 to-green-700', 'bg' => 'bg-green-50 dark:bg-green-900/20'],
                        ['label' => 'Pending Review', 'value' => number_format($pendingReview), 'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>', 'color' => 'from-yellow-500 to-yellow-600', 'bg' => 'bg-yellow-50 dark:bg-yellow-900/20'],
                        ['label' => 'Total Views', 'value' => number_format($totalViews), 'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>', 'color' => 'from-blue-600 to-blue-700', 'bg' => 'bg-blue-50 dark:bg-blue-900/20'],
                    ];
                @endphp
                @foreach($stats as $stat)
                <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-200 dark:border-gray-800 p-5 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ $stat['label'] }}</p>
                            <p class="text-3xl font-extrabold text-gray-900 dark:text-white mt-1">{{ $stat['value'] }}</p>
                        </div>
                        <div class="w-12 h-12 {{ $stat['bg'] }} rounded-lg flex items-center justify-center text-vnn-red dark:text-red-400">
                            {!! $stat['icon'] !!}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                {{-- Recent Articles --}}
                <div class="lg:col-span-2 bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-200 dark:border-gray-800 overflow-hidden">
                    <div class="px-5 py-4 border-b border-gray-100 dark:border-gray-800 flex items-center justify-between">
                        <h2 class="font-bold text-gray-900 dark:text-white">Recent Articles</h2>
                        <a href="{{ route('admin.articles.index') }}" wire:navigate class="text-sm text-vnn-red hover:underline font-medium">View All</a>
                    </div>
                    @if($recentArticles->isNotEmpty())
                    <div class="divide-y divide-gray-100 dark:divide-gray-800">
                        @foreach($recentArticles as $article)
                        <div class="px-5 py-3.5 flex items-center justify-between hover:bg-gray-50 dark:hover:bg-gray-800/50 transition">
                            <div class="flex items-center gap-3 min-w-0 flex-1">
                                @if($article->featured_image)
                                <img src="{{ asset('storage/' . $article->featured_image) }}" class="w-10 h-10 rounded-lg object-cover shrink-0">
                                @else
                                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-vnn-red/30 to-vnn-dark flex items-center justify-center shrink-0">
                                    <span class="text-white/30 font-extrabold">V</span>
                                </div>
                                @endif
                                <div class="min-w-0">
                                    <a href="{{ route('admin.articles.edit', $article) }}" wire:navigate class="text-sm font-medium text-gray-900 dark:text-gray-100 hover:text-vnn-red transition line-clamp-1">{{ $article->title }}</a>
                                    <div class="flex items-center gap-2 mt-0.5">
                                        <span class="text-xs text-gray-400">{{ $article->author?->name ?? 'Unknown' }}</span>
                                        <span class="text-gray-300">•</span>
                                        <span class="text-xs text-gray-400">{{ $article->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center gap-2 shrink-0 ml-3">
                                @php
                                $dotColors = ['draft' => 'bg-gray-400', 'pending_review' => 'bg-yellow-400', 'fact_checking' => 'bg-orange-400', 'approved' => 'bg-green-400', 'scheduled' => 'bg-blue-400', 'published' => 'bg-green-500', 'rejected' => 'bg-red-400'];
                                @endphp
                                <span class="flex items-center gap-1.5 text-xs text-gray-500">
                                    <span class="w-2 h-2 rounded-full {{ $dotColors[$article->status] ?? 'bg-gray-400' }}"></span>
                                    {{ str_replace('_', ' ', ucfirst($article->status)) }}
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="px-5 py-12 text-center">
                        <div class="w-16 h-16 mx-auto bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center mb-3">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                        </div>
                        <p class="text-gray-500 dark:text-gray-400 font-medium">No articles yet</p>
                        <p class="text-sm text-gray-400 mt-1">Create your first article to get started.</p>
                        <a href="{{ route('admin.articles.create') }}" class="inline-flex items-center gap-2 mt-4 text-sm font-semibold text-vnn-red hover:underline">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            Create Article
                        </a>
                    </div>
                    @endif
                </div>

                {{-- Quick Actions Sidebar --}}
                <div class="space-y-5">
                    {{-- Quick Actions --}}
                    <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-200 dark:border-gray-800 p-5">
                        <h2 class="font-bold text-gray-900 dark:text-white mb-4">Quick Actions</h2>
                        <div class="space-y-2">
                            <a href="{{ route('admin.articles.create') }}" class="flex items-center gap-3 px-4 py-3 bg-gray-50 dark:bg-gray-800 rounded-lg hover:bg-vnn-red hover:text-white transition group">
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                <span class="text-sm font-medium">Write New Article</span>
                            </a>
                            <a href="{{ route('admin.media.index') }}" class="flex items-center gap-3 px-4 py-3 bg-gray-50 dark:bg-gray-800 rounded-lg hover:bg-vnn-red hover:text-white transition group">
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                <span class="text-sm font-medium">Upload Media</span>
                            </a>
                            <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3 px-4 py-3 bg-gray-50 dark:bg-gray-800 rounded-lg hover:bg-vnn-red hover:text-white transition group">
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                                <span class="text-sm font-medium">Manage Categories</span>
                            </a>
                            <a href="{{ route('admin.breaking-news.index') }}" class="flex items-center gap-3 px-4 py-3 bg-gray-50 dark:bg-gray-800 rounded-lg hover:bg-vnn-red hover:text-white transition group">
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                <span class="text-sm font-medium">Add Breaking News</span>
                            </a>
                            <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-3 px-4 py-3 bg-gray-50 dark:bg-gray-800 rounded-lg hover:bg-vnn-red hover:text-white transition group">
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <span class="text-sm font-medium">Site Settings</span>
                            </a>
                        </div>
                    </div>

                    {{-- System Info --}}
                    <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-200 dark:border-gray-800 p-5">
                        <h2 class="font-bold text-gray-900 dark:text-white mb-4">System Info</h2>
                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-500">PHP Version</span>
                                <span class="font-medium text-gray-900 dark:text-gray-100">{{ PHP_VERSION }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Laravel Version</span>
                                <span class="font-medium text-gray-900 dark:text-gray-100">{{ app()->version() }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Environment</span>
                                <span class="font-medium text-gray-900 dark:text-gray-100">{{ app()->environment() }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Articles</span>
                                <span class="font-medium text-gray-900 dark:text-gray-100">{{ $totalArticles }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Categories</span>
                                <span class="font-medium text-gray-900 dark:text-gray-100">{{ \App\Models\Category::count() }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Users</span>
                                <span class="font-medium text-gray-900 dark:text-gray-100">{{ \App\Models\User::count() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
