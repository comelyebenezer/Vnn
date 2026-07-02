<div>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl font-extrabold text-gray-900 dark:text-white">Breaking News</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">Manage breaking news alerts</p>
            </div>
            <a href="{{ route('admin.breaking-news.create') }}" class="flex items-center gap-2 bg-vnn-red text-white text-sm font-bold px-4 py-2.5 rounded-lg hover:bg-vnn-red-dark transition shadow-lg shadow-vnn-red/20">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Add New
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

            <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-200 dark:border-gray-800 p-5 mb-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <input wire:model.live="search" type="text" placeholder="Search breaking news..." class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:border-vnn-red focus:ring-1 focus:ring-vnn-red">
                    </div>
                    <div>
                        <select wire:model.live="status" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:border-vnn-red focus:ring-1 focus:ring-vnn-red">
                            <option value="">All Statuses</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="text-sm text-gray-500 dark:text-gray-400 flex items-center">
                        Showing {{ $breakingNews->firstItem() }}-{{ $breakingNews->lastItem() }} of {{ $breakingNews->total() }}
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-200 dark:border-gray-800 overflow-hidden">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 dark:bg-gray-800/50 border-b border-gray-200 dark:border-gray-700">
                        <tr>
                            <th wire:click="sortBy('title')" class="text-left px-5 py-3.5 font-semibold text-gray-600 dark:text-gray-400 cursor-pointer hover:text-vnn-red">Title</th>
                            <th class="text-left px-5 py-3.5 font-semibold text-gray-600 dark:text-gray-400 hidden md:table-cell">News</th>
                            <th wire:click="sortBy('status')" class="text-left px-5 py-3.5 font-semibold text-gray-600 dark:text-gray-400 cursor-pointer hover:text-vnn-red">Status</th>
                            <th wire:click="sortBy('priority')" class="text-left px-5 py-3.5 font-semibold text-gray-600 dark:text-gray-400 cursor-pointer hover:text-vnn-red">Priority</th>
                            <th wire:click="sortBy('expires_at')" class="text-left px-5 py-3.5 font-semibold text-gray-600 dark:text-gray-400 cursor-pointer hover:text-vnn-red hidden md:table-cell">Expires</th>
                            <th class="px-5 py-3.5 font-semibold text-gray-600 dark:text-gray-400">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                        @forelse($breakingNews as $bn)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/30">
                            <td class="px-5 py-3.5">
                                <a href="{{ route('admin.breaking-news.edit', $bn) }}" class="font-medium text-vnn-blue hover:text-vnn-red transition">{{ $bn->title }}</a>
                            </td>
                            <td class="px-5 py-3.5 hidden md:table-cell">
                                @if($bn->article)
                                <a href="{{ route('admin.articles.edit', $bn->article) }}" class="text-vnn-blue hover:text-vnn-red text-xs font-semibold">{{ $bn->article->title }}</a>
                                @else
                                <span class="text-gray-400 text-xs">N/A</span>
                                @endif
                            </td>
                            <td class="px-5 py-3.5">
                                <span class="px-2 py-0.5 rounded text-xs font-semibold {{ $bn->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                    {{ ucfirst($bn->status) }}
                                </span>
                            </td>
                            <td class="px-5 py-3.5">
                                <span class="px-2 py-0.5 rounded text-xs font-semibold
                                    {{ $bn->priority >= 5 ? 'bg-red-100 text-red-700' : ($bn->priority >= 3 ? 'bg-yellow-100 text-yellow-700' : 'bg-gray-100 text-gray-600') }}">
                                    {{ $bn->priority }}
                                </span>
                            </td>
                            <td class="px-5 py-3.5 text-xs text-gray-500 dark:text-gray-400 hidden md:table-cell">
                                {{ $bn->expires_at ? $bn->expires_at->format('M d, Y H:i') : 'Never' }}
                            </td>
                            <td class="px-5 py-3.5">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.breaking-news.edit', $bn) }}" class="text-vnn-blue hover:text-vnn-red text-xs font-semibold">Edit</a>
                                    <button wire:click="deleteBreaking({{ $bn->id }})" class="text-red-500 hover:text-red-700 text-xs font-semibold" onclick="return confirm('Delete this breaking news entry?')">Delete</button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-5 py-12 text-center text-gray-400">No breaking news entries found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-5">
                {{ $breakingNews->links() }}
            </div>
        </div>
    </div>
</div>
