<div>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl font-extrabold text-gray-900 dark:text-white flex items-center gap-2">
                    <span class="bg-vnn-red text-white text-xs font-bold px-2 py-1 rounded">VNN</span>
                    List Management
                </h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">Manage global business listings and rankings</p>
            </div>
            <a href="{{ route('admin.vnn-list.create') }}" class="flex items-center gap-2 bg-vnn-red text-white text-sm font-bold px-4 py-2.5 rounded-lg hover:bg-vnn-red-dark transition shadow-lg shadow-vnn-red/20">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                New Listing
            </a>
        </div>
    </x-slot>

    {{-- Tab Navigation --}}
    <div class="border-b border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 lg:px-6 flex gap-0">
            <a href="{{ route('admin.vnn-list.index') }}" class="px-5 py-3 text-sm font-semibold border-b-2 border-vnn-red text-vnn-red transition">
                Listings
            </a>
            <a href="{{ route('admin.vnn-list.subcategories.index') }}" wire:navigate class="px-5 py-3 text-sm font-medium border-b-2 border-transparent text-gray-500 dark:text-gray-400 hover:text-vnn-red hover:border-vnn-red/30 transition">
                Categories
            </a>
        </div>
    </div>

    <div class="py-6 px-4 lg:px-6">
        <div class="max-w-7xl mx-auto">
            @if(session('message'))
            <div class="bg-green-50 dark:bg-green-900/30 border-l-4 border-green-500 text-green-700 dark:text-green-300 p-4 mb-6 rounded-r-lg text-sm flex items-center gap-3">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ session('message') }}
            </div>
            @endif

            {{-- Stats Cards --}}
            <div class="grid grid-cols-2 lg:grid-cols-5 gap-3 mb-6">
                <div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 p-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-vnn-red/10 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-vnn-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                        </div>
                        <div>
                            <div class="text-xl font-black text-gray-900 dark:text-white">{{ $total }}</div>
                            <div class="text-[10px] text-gray-400 uppercase tracking-wider">Total</div>
                        </div>
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 p-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-green-500/10 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <div class="text-xl font-black text-gray-900 dark:text-white">{{ $published }}</div>
                            <div class="text-[10px] text-gray-400 uppercase tracking-wider">Published</div>
                        </div>
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 p-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-yellow-500/10 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </div>
                        <div>
                            <div class="text-xl font-black text-gray-900 dark:text-white">{{ $draft }}</div>
                            <div class="text-[10px] text-gray-400 uppercase tracking-wider">Drafts</div>
                        </div>
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 p-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-purple-500/10 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-purple-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        </div>
                        <div>
                            <div class="text-xl font-black text-gray-900 dark:text-white">{{ $featured }}</div>
                            <div class="text-[10px] text-gray-400 uppercase tracking-wider">Featured</div>
                        </div>
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 p-4 col-span-2 lg:col-span-1">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-blue-500/10 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        </div>
                        <div>
                            <div class="text-xl font-black text-gray-900 dark:text-white">{{ number_format($totalViews) }}</div>
                            <div class="text-[10px] text-gray-400 uppercase tracking-wider">Total Views</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Filters --}}
            <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-200 dark:border-gray-800 p-4 mb-6">
                <div class="flex flex-col md:flex-row gap-3">
                    <div class="flex-1 relative">
                        <svg class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        <input wire:model.live="search" type="text" placeholder="Search by title or description..." class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg pl-10 pr-4 py-2.5 text-sm focus:outline-none focus:border-vnn-red focus:ring-1 focus:ring-vnn-red">
                    </div>
                    <div class="flex gap-2">
                        <select wire:model.live="status" class="border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:border-vnn-red focus:ring-1 focus:ring-vnn-red">
                            <option value="">All Status</option>
                            <option value="published">Published</option>
                            <option value="draft">Draft</option>
                            <option value="pending_review">Pending Review</option>
                            <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option>
                        </select>
                        <div class="flex border border-gray-300 dark:border-gray-600 rounded-lg overflow-hidden">
                            <button wire:click="$set('viewMode', 'grid')" class="px-3 py-2 text-sm {{ $viewMode === 'grid' ? 'bg-vnn-red text-white' : 'bg-white dark:bg-gray-800 text-gray-500 hover:bg-gray-50' }} transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                            </button>
                            <button wire:click="$set('viewMode', 'table')" class="px-3 py-2 text-sm {{ $viewMode === 'table' ? 'bg-vnn-red text-white' : 'bg-white dark:bg-gray-800 text-gray-500 hover:bg-gray-50' }} transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-between mt-3 pt-3 border-t border-gray-100 dark:border-gray-800">
                    <span class="text-xs text-gray-400">Showing {{ $articles->firstItem() ?? 0 }}-{{ $articles->lastItem() ?? 0 }} of {{ $articles->total() }}</span>
                </div>
            </div>

            {{-- Grid View --}}
            @if($viewMode === 'grid')
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                @forelse($articles as $article)
                <div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 overflow-hidden hover:shadow-lg hover:border-vnn-red/30 transition-all duration-300 group">
                    {{-- Image --}}
                    <div class="aspect-[16/10] bg-gray-100 dark:bg-gray-800 overflow-hidden relative">
                        @if($article->featured_image)
                        <img src="{{ asset('files/' . $article->featured_image) }}" alt="{{ $article->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        @else
                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-800 dark:to-gray-900">
                            <span class="text-4xl font-black text-gray-200 dark:text-gray-700 font-heading">{{ strtoupper(substr($article->title, 0, 2)) }}</span>
                        </div>
                        @endif

                        {{-- Status Badge --}}
                        @php
                        $statusColors = [
                            'draft' => 'bg-gray-500',
                            'pending_review' => 'bg-yellow-500',
                            'fact_checking' => 'bg-orange-500',
                            'approved' => 'bg-blue-500',
                            'scheduled' => 'bg-indigo-500',
                            'published' => 'bg-green-500',
                            'rejected' => 'bg-red-500',
                        ];
                        @endphp
                        <span class="absolute top-2 left-2 {{ $statusColors[$article->status] ?? 'bg-gray-500' }} text-white text-[10px] font-bold px-2 py-0.5 rounded-full uppercase">{{ str_replace('_', ' ', $article->status) }}</span>

                        {{-- Featured Star --}}
                        @if($article->is_featured)
                        <button wire:click="toggleFeatured({{ $article->id }})" class="absolute top-2 right-2 w-7 h-7 bg-yellow-500 rounded-full flex items-center justify-center shadow-lg" title="Remove from featured">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        </button>
                        @else
                        <button wire:click="toggleFeatured({{ $article->id }})" class="absolute top-2 right-2 w-7 h-7 bg-black/30 backdrop-blur-sm rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition" title="Add to featured">
                            <svg class="w-4 h-4 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        </button>
                        @endif

                        {{-- Views --}}
                        <div class="absolute bottom-2 right-2 bg-black/40 backdrop-blur-sm rounded-md px-2 py-0.5 text-white text-[10px] font-medium flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            {{ number_format($article->view_count) }}
                        </div>
                    </div>

                    {{-- Content --}}
                    <div class="p-3.5">
                        <h3 class="text-sm font-bold text-gray-900 dark:text-white line-clamp-2 font-heading group-hover:text-vnn-red transition">{{ $article->title }}</h3>
                        @if($article->excerpt)
                        <p class="text-xs text-gray-400 mt-1 line-clamp-2">{{ $article->excerpt }}</p>
                        @endif

                        <div class="flex items-center gap-2 mt-3 pt-3 border-t border-gray-100 dark:border-gray-800">
                            <span class="text-[10px] text-gray-400">{{ $article->created_at->format('M d, Y') }}</span>
                            <span class="text-gray-300 dark:text-gray-700">·</span>
                            <span class="text-[10px] text-gray-400">{{ $article->reading_time }} min read</span>
                        </div>

                        {{-- Actions --}}
                        <div class="flex items-center gap-1.5 mt-3">
                            <a href="{{ route('admin.vnn-list.edit', $article) }}" wire:navigate class="flex-1 flex items-center justify-center gap-1.5 bg-vnn-red/10 text-vnn-red text-xs font-semibold py-2 rounded-lg hover:bg-vnn-red hover:text-white transition">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                Edit
                            </a>
                            @if($article->status === 'published')
                            <a href="{{ route('frontend.article', $article->slug) }}" target="_blank" class="flex items-center justify-center bg-gray-100 dark:bg-gray-800 text-gray-500 text-xs py-2 px-2.5 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-700 transition">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                            @endif
                            <button wire:click="deleteArticle({{ $article->id }})" onclick="return confirm('Delete this listing?')" class="flex items-center justify-center bg-gray-100 dark:bg-gray-800 text-red-400 text-xs py-2 px-2.5 rounded-lg hover:bg-red-50 dark:hover:bg-red-900/20 transition">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-20">
                    <div class="w-20 h-20 mx-auto bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-10 h-10 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">No listings found</h3>
                    <p class="text-sm text-gray-400 mt-1">Create your first VNN List entry to get started.</p>
                    <a href="{{ route('admin.vnn-list.create') }}" class="inline-flex items-center gap-2 mt-4 bg-vnn-red text-white text-sm font-bold px-5 py-2.5 rounded-lg hover:bg-vnn-red-dark transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        New Listing
                    </a>
                </div>
                @endforelse
            </div>

            {{-- Table View --}}
            @else
            <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-200 dark:border-gray-800 overflow-hidden">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 dark:bg-gray-800/50 border-b border-gray-200 dark:border-gray-700">
                        <tr>
                            <th class="text-left px-5 py-3.5 font-semibold text-gray-600 dark:text-gray-400">Listing</th>
                            <th class="text-left px-5 py-3.5 font-semibold text-gray-600 dark:text-gray-400 hidden md:table-cell">Author</th>
                            <th class="text-left px-5 py-3.5 font-semibold text-gray-600 dark:text-gray-400">Status</th>
                            <th class="text-left px-5 py-3.5 font-semibold text-gray-600 dark:text-gray-400 hidden lg:table-cell">Views</th>
                            <th class="text-left px-5 py-3.5 font-semibold text-gray-600 dark:text-gray-400 hidden lg:table-cell">Date</th>
                            <th class="px-5 py-3.5 font-semibold text-gray-600 dark:text-gray-400 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                        @forelse($articles as $article)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/30 transition">
                            <td class="px-5 py-3.5">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg overflow-hidden bg-gray-100 dark:bg-gray-800 shrink-0 flex items-center justify-center">
                                        @if($article->featured_image)
                                        <img src="{{ asset('files/' . $article->featured_image) }}" class="w-full h-full object-cover">
                                        @else
                                        <span class="text-xs font-bold text-gray-300 dark:text-gray-600">{{ strtoupper(substr($article->title, 0, 2)) }}</span>
                                        @endif
                                    </div>
                                    <div class="min-w-0">
                                        <a href="{{ route('admin.vnn-list.edit', $article) }}" wire:navigate class="font-medium text-gray-900 dark:text-gray-100 hover:text-vnn-red transition line-clamp-1">{{ $article->title }}</a>
                                        <div class="flex items-center gap-2 mt-0.5">
                                            @if($article->is_featured)<span class="text-yellow-600 text-[10px] font-bold flex items-center gap-0.5"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg> Featured</span>@endif
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-3.5 text-gray-500 dark:text-gray-400 hidden md:table-cell text-xs">{{ $article->author?->name ?? '—' }}</td>
                            <td class="px-5 py-3.5">
                                @php
                                $statusColors = [
                                    'draft' => 'bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-300',
                                    'pending_review' => 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-300',
                                    'fact_checking' => 'bg-orange-100 text-orange-700 dark:bg-orange-900/30 dark:text-orange-300',
                                    'approved' => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300',
                                    'scheduled' => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300',
                                    'published' => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300',
                                    'rejected' => 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-300',
                                ];
                                @endphp
                                <span class="px-2 py-1 rounded-lg text-[10px] font-bold uppercase {{ $statusColors[$article->status] ?? 'bg-gray-100' }}">
                                    {{ str_replace('_', ' ', $article->status) }}
                                </span>
                            </td>
                            <td class="px-5 py-3.5 text-gray-500 dark:text-gray-400 hidden lg:table-cell font-mono text-xs">{{ number_format($article->view_count) }}</td>
                            <td class="px-5 py-3.5 text-gray-500 dark:text-gray-400 hidden lg:table-cell text-xs">{{ $article->created_at->format('M d, Y') }}</td>
                            <td class="px-5 py-3.5">
                                <div class="flex items-center justify-end gap-1.5">
                                    <button wire:click="toggleFeatured({{ $article->id }})" class="p-1.5 rounded-lg {{ $article->is_featured ? 'text-yellow-500 bg-yellow-50 dark:bg-yellow-900/20' : 'text-gray-400 hover:text-yellow-500 hover:bg-yellow-50 dark:hover:bg-yellow-900/20' }} transition" title="{{ $article->is_featured ? 'Remove from featured' : 'Add to featured' }}">
                                        <svg class="w-4 h-4" fill="{{ $article->is_featured ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                    </button>
                                    <a href="{{ route('admin.vnn-list.edit', $article) }}" wire:navigate class="p-1.5 rounded-lg text-gray-400 hover:text-vnn-red hover:bg-red-50 dark:hover:bg-red-900/20 transition" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    @if($article->status === 'published')
                                    <a href="{{ route('frontend.article', $article->slug) }}" target="_blank" class="p-1.5 rounded-lg text-gray-400 hover:text-blue-500 hover:bg-blue-50 dark:hover:bg-blue-900/20 transition" title="View">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                    </a>
                                    @endif
                                    <button wire:click="deleteArticle({{ $article->id }})" onclick="return confirm('Delete this listing?')" class="p-1.5 rounded-lg text-gray-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 transition" title="Delete">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-5 py-16 text-center">
                                <div class="w-16 h-16 mx-auto bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center mb-3">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                                </div>
                                <p class="text-gray-500 dark:text-gray-400 font-medium">No listings found</p>
                                <p class="text-sm text-gray-400 mt-1">Create your first VNN List entry to get started.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @endif

            <div class="mt-5">
                {{ $articles->links() }}
            </div>
        </div>
    </div>
</div>
