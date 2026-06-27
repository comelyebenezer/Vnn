<div>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-vnn-blue leading-tight">Articles</h2>
            <a href="{{ route('admin.articles.create') }}" class="bg-vnn-red text-white text-sm font-bold px-4 py-2 rounded hover:bg-vnn-red-dark transition">+ New Article</a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('message'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 text-sm rounded">{{ session('message') }}</div>
            @endif

            {{-- Filters --}}
            <div class="bg-white rounded-lg shadow-sm p-4 mb-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <input wire:model.live="search" type="text" placeholder="Search articles..." class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
                    </div>
                    <div>
                        <select wire:model.live="status" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
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
                    <div>
                        <select wire:model.live="category_id" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
                            <option value="">All Categories</option>
                            @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="text-sm text-gray-500 flex items-center">
                        Showing {{ $articles->firstItem() }}-{{ $articles->lastItem() }} of {{ $articles->total() }}
                    </div>
                </div>
            </div>

            {{-- Articles Table --}}
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th wire:click="sortBy('title')" class="text-left px-4 py-3 font-semibold text-gray-600 cursor-pointer hover:text-vnn-blue">Title</th>
                            <th wire:click="sortBy('author')" class="text-left px-4 py-3 font-semibold text-gray-600 cursor-pointer hover:text-vnn-blue hidden md:table-cell">Author</th>
                            <th wire:click="sortBy('status')" class="text-left px-4 py-3 font-semibold text-gray-600 cursor-pointer hover:text-vnn-blue">Status</th>
                            <th wire:click="sortBy('category')" class="text-left px-4 py-3 font-semibold text-gray-600 cursor-pointer hover:text-vnn-blue hidden md:table-cell">Category</th>
                            <th wire:click="sortBy('view_count')" class="text-left px-4 py-3 font-semibold text-gray-600 cursor-pointer hover:text-vnn-blue hidden lg:table-cell">Views</th>
                            <th wire:click="sortBy('created_at')" class="text-left px-4 py-3 font-semibold text-gray-600 cursor-pointer hover:text-vnn-blue hidden lg:table-cell">Date</th>
                            <th class="px-4 py-3 font-semibold text-gray-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($articles as $article)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-3">
                                    @if($article->featured_image)
                                    <img src="{{ asset('storage/' . $article->featured_image) }}" class="w-10 h-10 rounded object-cover hidden sm:block">
                                    @endif
                                    <div>
                                        <a href="{{ route('admin.articles.edit', $article) }}" class="font-medium text-vnn-blue hover:text-vnn-red transition line-clamp-2">{{ $article->title }}</a>
                                        @if($article->is_featured)<span class="text-yellow-600 text-xs ml-1">★</span>@endif
                                        @if($article->is_breaking)<span class="text-vnn-red text-xs ml-1">⚡</span>@endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-gray-500 hidden md:table-cell">{{ $article->author?->name ?? '—' }}</td>
                            <td class="px-4 py-3">
                                @php
                                $statusColors = [
                                    'draft' => 'bg-gray-100 text-gray-600',
                                    'pending_review' => 'bg-yellow-100 text-yellow-700',
                                    'fact_checking' => 'bg-orange-100 text-orange-700',
                                    'approved' => 'bg-green-100 text-green-700',
                                    'scheduled' => 'bg-blue-100 text-blue-700',
                                    'published' => 'bg-green-100 text-green-700',
                                    'rejected' => 'bg-red-100 text-red-700',
                                ];
                                @endphp
                                <span class="px-2 py-0.5 rounded text-xs font-semibold {{ $statusColors[$article->status] ?? 'bg-gray-100' }}">
                                    {{ str_replace('_', ' ', ucfirst($article->status)) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-gray-500 hidden md:table-cell">{{ $article->category?->name ?? '—' }}</td>
                            <td class="px-4 py-3 text-gray-500 hidden lg:table-cell">{{ number_format($article->view_count) }}</td>
                            <td class="px-4 py-3 text-gray-500 hidden lg:table-cell text-xs">{{ $article->created_at->format('M d, Y') }}</td>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.articles.edit', $article) }}" class="text-vnn-blue hover:text-vnn-red text-xs font-semibold">Edit</a>
                                    <button wire:click="deleteArticle({{ $article->id }})" class="text-red-500 hover:text-red-700 text-xs font-semibold" onclick="return confirm('Delete this article?')">Delete</button>
                                    @if($article->status === 'published')
                                    <a href="{{ route('frontend.article', $article->slug) }}" target="_blank" class="text-gray-400 hover:text-vnn-blue text-xs">View</a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-4 py-12 text-center text-gray-400">No articles found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $articles->links() }}
            </div>
        </div>
    </div>
</div>
