<div>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl font-extrabold text-gray-900 dark:text-white">Gallery</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">Manage gallery images</p>
            </div>
            <a href="{{ route('admin.gallery.create') }}" class="flex items-center gap-2 bg-vnn-red text-white text-sm font-bold px-4 py-2.5 rounded-lg hover:bg-vnn-red-dark transition shadow-lg shadow-vnn-red/20">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Add Image
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
                        <input wire:model.live="search" type="text" placeholder="Search gallery..." class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:border-vnn-red focus:ring-1 focus:ring-vnn-red">
                    </div>
                    <div>
                        <select wire:model.live="status" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:border-vnn-red focus:ring-1 focus:ring-vnn-red">
                            <option value="">All Statuses</option>
                            <option value="published">Published</option>
                            <option value="draft">Draft</option>
                        </select>
                    </div>
                    <div class="text-sm text-gray-500 dark:text-gray-400 flex items-center">
                        Showing {{ $galleries->firstItem() }}-{{ $galleries->lastItem() }} of {{ $galleries->total() }}
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                @forelse($galleries as $item)
                <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-200 dark:border-gray-800 overflow-hidden group">
                    <div class="aspect-square bg-gray-100 dark:bg-gray-800 overflow-hidden">
                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                    </div>
                    <div class="p-3">
                        <h3 class="text-sm font-bold text-gray-900 dark:text-white truncate">{{ $item->title }}</h3>
                        @if($item->caption)
                        <p class="text-xs text-gray-500 dark:text-gray-400 truncate mt-0.5">{{ $item->caption }}</p>
                        @endif
                        <div class="flex items-center justify-between mt-2">
                            <span class="px-2 py-0.5 rounded text-xs font-semibold {{ $item->status === 'published' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                {{ ucfirst($item->status) }}
                            </span>
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.gallery.edit', $item->id) }}" class="text-vnn-blue hover:text-vnn-red text-xs font-semibold">Edit</a>
                                <button wire:click="deleteGallery({{ $item->id }})" class="text-red-500 hover:text-red-700 text-xs font-semibold" onclick="return confirm('Delete this image?')">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-12 text-gray-400">No gallery images found.</div>
                @endforelse
            </div>

            <div class="mt-5">
                {{ $galleries->links() }}
            </div>
        </div>
    </div>
</div>
