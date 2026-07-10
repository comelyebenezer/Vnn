<div>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl font-extrabold text-gray-900 dark:text-white">Live Updates</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">Manage live updates (videos & images)</p>
            </div>
            <a href="{{ route('admin.live.create') }}" class="flex items-center gap-2 bg-vnn-red text-white text-sm font-bold px-4 py-2.5 rounded-lg hover:bg-vnn-red-dark transition shadow-lg shadow-vnn-red/20">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                New Live Update
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
                        <input wire:model.live="search" type="text" placeholder="Search live updates..." class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:border-vnn-red focus:ring-1 focus:ring-vnn-red">
                    </div>
                    <div>
                        <select wire:model.live="status" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:border-vnn-red">
                            <option value="">All Status</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- Table --}}
            <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-200 dark:border-gray-800 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 dark:bg-gray-800/50 border-b border-gray-200 dark:border-gray-700">
                            <tr>
                                <th wire:click="sortBy('title')" class="text-left px-5 py-3.5 font-semibold text-gray-600 dark:text-gray-400 cursor-pointer hover:text-vnn-red">Title</th>
                                <th class="text-left px-5 py-3.5 font-semibold text-gray-600 dark:text-gray-400 hidden md:table-cell">Type</th>
                                <th wire:click="sortBy('is_live')" class="text-left px-5 py-3.5 font-semibold text-gray-600 dark:text-gray-400 cursor-pointer hover:text-vnn-red hidden md:table-cell">Live</th>
                                <th wire:click="sortBy('status')" class="text-left px-5 py-3.5 font-semibold text-gray-600 dark:text-gray-400 cursor-pointer hover:text-vnn-red">Status</th>
                                <th wire:click="sortBy('created_at')" class="text-left px-5 py-3.5 font-semibold text-gray-600 dark:text-gray-400 cursor-pointer hover:text-vnn-red hidden md:table-cell">Created</th>
                                <th class="px-5 py-3.5 font-semibold text-gray-600 dark:text-gray-400">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                            @forelse($liveUpdates as $live)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/30">
                                <td class="px-5 py-3.5">
                                    <a href="{{ route('admin.live.edit', $live) }}" class="font-medium text-vnn-blue hover:text-vnn-red transition">{{ $live->title }}</a>
                                </td>
                                <td class="px-5 py-3.5 hidden md:table-cell">
                                    <span class="text-xs text-gray-500">{{ $live->media_type === 'image' ? 'Image' : $live->video_type }}</span>
                                </td>
                                <td class="px-5 py-3.5 hidden md:table-cell">
                                    @if($live->is_live)
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-bold bg-red-100 text-red-700">
                                        <span class="w-1.5 h-1.5 bg-red-600 rounded-full animate-pulse"></span>
                                        LIVE
                                    </span>
                                    @else
                                    <span class="text-xs text-gray-400">Offline</span>
                                    @endif
                                </td>
                                <td class="px-5 py-3.5">
                                    <span class="px-2 py-0.5 rounded text-xs font-semibold {{ $live->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                        {{ ucfirst($live->status) }}
                                    </span>
                                </td>
                                <td class="px-5 py-3.5 text-xs text-gray-500 dark:text-gray-400 hidden md:table-cell">
                                    {{ $live->created_at->format('M d, Y') }}
                                </td>
                                <td class="px-5 py-3.5">
                                    <div class="flex items-center gap-2">
                                        <button wire:click="toggleLive({{ $live->id }})" class="inline-flex items-center gap-1 text-xs font-semibold px-2.5 py-1.5 rounded-lg transition {{ $live->is_live ? 'bg-red-50 text-red-600 hover:bg-red-100 dark:bg-red-900/20' : 'bg-green-50 text-green-600 hover:bg-green-100 dark:bg-green-900/20' }}">
                                            {{ $live->is_live ? 'Stop Live' : 'Go Live' }}
                                        </button>
                                        <a href="{{ route('admin.live.edit', $live) }}" class="text-vnn-blue hover:text-vnn-red text-xs font-semibold">Edit</a>
                                        <button wire:click="deleteLive({{ $live->id }})" onclick="return confirm('Delete this live update?')" class="text-red-500 hover:text-red-700 text-xs font-semibold">Delete</button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-5 py-12 text-center text-gray-400">
                                <div class="flex flex-col items-center gap-2">
                                    <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                    <p>No live updates found.</p>
                                    <a href="{{ route('admin.live.create') }}" class="text-vnn-red hover:underline text-sm font-semibold">Create your first live update</a>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="px-5 py-4 border-t border-gray-200 dark:border-gray-700">
                    {{ $liveUpdates->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
