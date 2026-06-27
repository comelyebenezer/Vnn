<div>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl font-extrabold text-gray-900 dark:text-white">Comments</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">Manage reader comments</p>
            </div>
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
                        <input wire:model.live="search" type="text" placeholder="Search comments..." class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:border-vnn-red focus:ring-1 focus:ring-vnn-red">
                    </div>
                    <div>
                        <select wire:model.live="status" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:border-vnn-red focus:ring-1 focus:ring-vnn-red">
                            <option value="">All Statuses</option>
                            <option value="pending">Pending</option>
                            <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option>
                        </select>
                    </div>
                    <div class="text-sm text-gray-500 dark:text-gray-400 flex items-center">
                        Showing {{ $comments->firstItem() }}-{{ $comments->lastItem() }} of {{ $comments->total() }}
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-200 dark:border-gray-800 overflow-hidden">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 dark:bg-gray-800/50 border-b border-gray-200 dark:border-gray-700">
                        <tr>
                            <th class="text-left px-5 py-3.5 font-semibold text-gray-600 dark:text-gray-400">Comment</th>
                            <th class="text-left px-5 py-3.5 font-semibold text-gray-600 dark:text-gray-400 hidden md:table-cell">Article</th>
                            <th class="text-left px-5 py-3.5 font-semibold text-gray-600 dark:text-gray-400 hidden sm:table-cell">Commenter</th>
                            <th wire:click="sortBy('status')" class="text-left px-5 py-3.5 font-semibold text-gray-600 dark:text-gray-400 cursor-pointer hover:text-vnn-red">Status</th>
                            <th wire:click="sortBy('created_at')" class="text-left px-5 py-3.5 font-semibold text-gray-600 dark:text-gray-400 cursor-pointer hover:text-vnn-red hidden md:table-cell">Date</th>
                            <th class="px-5 py-3.5 font-semibold text-gray-600 dark:text-gray-400">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                        @forelse($comments as $comment)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/30">
                            <td class="px-5 py-3.5 max-w-xs">
                                <div class="truncate text-gray-700 dark:text-gray-300">{{ $comment->body }}</div>
                            </td>
                            <td class="px-5 py-3.5 hidden md:table-cell">
                                <a href="{{ route('admin.articles.edit', $comment->article_id) }}" class="text-vnn-blue hover:text-vnn-red text-xs font-semibold">{{ $comment->article?->title ?? 'N/A' }}</a>
                            </td>
                            <td class="px-5 py-3.5 hidden sm:table-cell">
                                <span class="text-xs text-gray-600 dark:text-gray-400">{{ $comment->user?->name ?? $comment->guest_name ?? 'Guest' }}</span>
                                @if($comment->user?->email || $comment->guest_email)
                                <br><span class="text-xs text-gray-400">{{ $comment->user?->email ?? $comment->guest_email }}</span>
                                @endif
                            </td>
                            <td class="px-5 py-3.5">
                                <span class="px-2 py-0.5 rounded text-xs font-semibold
                                    {{ $comment->status === 'approved' ? 'bg-green-100 text-green-700' : '' }}
                                    {{ $comment->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                    {{ $comment->status === 'rejected' ? 'bg-red-100 text-red-700' : '' }}">
                                    {{ ucfirst($comment->status) }}
                                </span>
                            </td>
                            <td class="px-5 py-3.5 text-xs text-gray-500 dark:text-gray-400 hidden md:table-cell">{{ $comment->created_at->format('M d, Y H:i') }}</td>
                            <td class="px-5 py-3.5">
                                <div class="flex items-center gap-2">
                                    @if($comment->status !== 'approved')
                                    <button wire:click="approveComment({{ $comment->id }})" class="text-green-500 hover:text-green-700 text-xs font-semibold">Approve</button>
                                    @endif
                                    @if($comment->status !== 'rejected')
                                    <button wire:click="rejectComment({{ $comment->id }})" class="text-orange-500 hover:text-orange-700 text-xs font-semibold">Reject</button>
                                    @endif
                                    <button wire:click="deleteComment({{ $comment->id }})" class="text-red-500 hover:text-red-700 text-xs font-semibold" onclick="return confirm('Delete this comment?')">Delete</button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-5 py-12 text-center text-gray-400">No comments found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-5">
                {{ $comments->links() }}
            </div>
        </div>
    </div>
</div>
