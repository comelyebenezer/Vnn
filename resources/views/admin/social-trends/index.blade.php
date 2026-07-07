<div>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl font-extrabold text-gray-900 dark:text-white">Social Trends</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">Manage trending social videos and viral content</p>
            </div>
            <a href="{{ route('admin.social-trends.create') }}" class="flex items-center gap-2 bg-vnn-red text-white text-sm font-bold px-4 py-2.5 rounded-lg hover:bg-vnn-red-dark transition shadow-lg shadow-vnn-red/20">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                New Video
            </a>
        </div>
    </x-slot>

    <div class="py-6 px-4 lg:px-6">
        <div class="max-w-7xl mx-auto">
            @if(session('message'))
            <div class="bg-green-50 dark:bg-green-900/30 border-l-4 border-green-500 text-green-700 dark:text-green-300 p-4 mb-6 rounded-r-lg text-sm flex items-center gap-3">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ session('message') }}
            </div>
            @endif

            {{-- Filters --}}
            <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-200 dark:border-gray-800 p-5 mb-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <input wire:model.live="search" type="text" placeholder="Search videos..." class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:border-vnn-red focus:ring-1 focus:ring-vnn-red">
                    </div>
                    <div>
                        <select wire:model.live="status" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:border-vnn-red focus:ring-1 focus:ring-vnn-red">
                            <option value="">All Statuses</option>
                            <option value="draft">Draft</option>
                            <option value="pending_review">Pending Review</option>
                            <option value="fact_checking">Fact Checking</option>
                            <option value="approved">Approved</option>
                            <option value="scheduled">Scheduled</option>
                            <option value="published">Published</option>
                            <option value="rejected">Rejected</option>
                        </select>
                    </div>
                    <div class="text-sm text-gray-500 flex items-center">
                        Showing {{ $articles->firstItem() }}-{{ $articles->lastItem() }} of {{ $articles->total() }}
                    </div>
                </div>
            </div>

            {{-- Articles Table --}}
            <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-200 dark:border-gray-800 overflow-hidden">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 dark:bg-gray-800/50 border-b border-gray-200 dark:border-gray-700">
                        <tr>
                            <th wire:click="sortBy('title')" class="text-left px-5 py-3.5 font-semibold text-gray-600 dark:text-gray-400 cursor-pointer hover:text-vnn-red">Title</th>
                            <th wire:click="sortBy('author')" class="text-left px-5 py-3.5 font-semibold text-gray-600 dark:text-gray-400 cursor-pointer hover:text-vnn-red hidden md:table-cell">Author</th>
                            <th wire:click="sortBy('status')" class="text-left px-5 py-3.5 font-semibold text-gray-600 dark:text-gray-400 cursor-pointer hover:text-vnn-red">Status</th>
                            <th wire:click="sortBy('view_count')" class="text-left px-5 py-3.5 font-semibold text-gray-600 dark:text-gray-400 cursor-pointer hover:text-vnn-red hidden lg:table-cell">Views</th>
                            <th wire:click="sortBy('created_at')" class="text-left px-5 py-3.5 font-semibold text-gray-600 dark:text-gray-400 cursor-pointer hover:text-vnn-red hidden lg:table-cell">Date</th>
                            <th class="px-5 py-3.5 font-semibold text-gray-600 dark:text-gray-400">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                        @forelse($articles as $article)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/30 transition">
                            <td class="px-5 py-3.5">
                                <div class="flex items-center gap-3">
                                    @if($article->featured_image)
                                    <img src="{{ asset('storage/' . $article->featured_image) }}" class="w-10 h-10 rounded-lg object-cover hidden sm:block">
                                    @endif
                                    <div>
                                        <a href="{{ route('admin.social-trends.edit', $article) }}" wire:navigate class="font-medium text-gray-900 dark:text-gray-100 hover:text-vnn-red transition line-clamp-2">{{ $article->title }}</a>
                                        <div class="flex items-center gap-2 mt-0.5">
                                            @if($article->is_featured)<span class="text-yellow-600 text-xs">★ Featured</span>@endif
                                            <span class="text-vnn-blue text-xs">▶ Video</span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-3.5 text-gray-500 dark:text-gray-400 hidden md:table-cell">{{ $article->author?->name ?? '—' }}</td>
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
                                <span class="px-2.5 py-1 rounded-lg text-xs font-semibold {{ $statusColors[$article->status] ?? 'bg-gray-100' }}">
                                    {{ str_replace('_', ' ', ucfirst($article->status)) }}
                                </span>
                            </td>
                            <td class="px-5 py-3.5 text-gray-500 dark:text-gray-400 hidden lg:table-cell font-mono">{{ number_format($article->view_count) }}</td>
                            <td class="px-5 py-3.5 text-gray-500 dark:text-gray-400 hidden lg:table-cell text-xs">{{ $article->created_at->format('M d, Y') }}</td>
                            <td class="px-5 py-3.5">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.social-trends.edit', $article) }}" wire:navigate class="inline-flex items-center gap-1 text-vnn-red hover:text-vnn-red-dark text-xs font-semibold bg-red-50 dark:bg-red-900/20 px-2.5 py-1.5 rounded-lg hover:bg-red-100 dark:hover:bg-red-900/40 transition">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        Edit
                                    </a>
                                    <button wire:click="deleteArticle({{ $article->id }})" onclick="return confirm('Delete this video?')" class="inline-flex items-center gap-1 text-red-500 hover:text-red-700 text-xs font-semibold bg-red-50 dark:bg-red-900/20 px-2.5 py-1.5 rounded-lg hover:bg-red-100 dark:hover:bg-red-900/40 transition">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        Delete
                                    </button>
                                    @if($article->status === 'published')
                                    <a href="{{ route('frontend.article', $article->slug) }}" target="_blank" class="inline-flex items-center gap-1 text-gray-400 hover:text-vnn-blue text-xs px-2.5 py-1.5 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                    </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-5 py-16 text-center">
                                <div class="w-16 h-16 mx-auto bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center mb-3">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                </div>
                                <p class="text-gray-500 dark:text-gray-400 font-medium">No videos found</p>
                                <p class="text-sm text-gray-400 mt-1">Add your first trending video to get started.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-5">
                {{ $articles->links() }}
            </div>
        </div>
    </div>
</div>
