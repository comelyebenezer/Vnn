<div>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-vnn-blue leading-tight">Comments</h2>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('message'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 text-sm rounded">{{ session('message') }}</div>
            @endif

            <div class="bg-white rounded-lg shadow-sm p-4 mb-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <input wire:model.live="search" type="text" placeholder="Search comments..." class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
                    </div>
                    <div>
                        <select wire:model.live="status" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
                            <option value="">All Statuses</option>
                            <option value="pending">Pending</option>
                            <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option>
                        </select>
                    </div>
                    <div class="text-sm text-gray-500 flex items-center">
                        Showing {{ $comments->firstItem() }}-{{ $comments->lastItem() }} of {{ $comments->total() }}
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="text-left px-4 py-3 font-semibold text-gray-600">Comment</th>
                            <th class="text-left px-4 py-3 font-semibold text-gray-600 hidden md:table-cell">Article</th>
                            <th class="text-left px-4 py-3 font-semibold text-gray-600 hidden sm:table-cell">Commenter</th>
                            <th wire:click="sortBy('status')" class="text-left px-4 py-3 font-semibold text-gray-600 cursor-pointer hover:text-vnn-blue">Status</th>
                            <th wire:click="sortBy('created_at')" class="text-left px-4 py-3 font-semibold text-gray-600 cursor-pointer hover:text-vnn-blue hidden md:table-cell">Date</th>
                            <th class="px-4 py-3 font-semibold text-gray-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($comments as $comment)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 max-w-xs">
                                <div class="truncate text-gray-700">{{ $comment->body }}</div>
                            </td>
                            <td class="px-4 py-3 hidden md:table-cell">
                                <a href="{{ route('admin.articles.edit', $comment->article_id) }}" class="text-vnn-blue hover:text-vnn-red text-xs font-semibold">{{ $comment->article?->title ?? 'N/A' }}</a>
                            </td>
                            <td class="px-4 py-3 hidden sm:table-cell">
                                <span class="text-xs text-gray-600">{{ $comment->user?->name ?? $comment->guest_name ?? 'Guest' }}</span>
                                @if($comment->user?->email || $comment->guest_email)
                                <br><span class="text-xs text-gray-400">{{ $comment->user?->email ?? $comment->guest_email }}</span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-0.5 rounded text-xs font-semibold
                                    {{ $comment->status === 'approved' ? 'bg-green-100 text-green-700' : '' }}
                                    {{ $comment->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                    {{ $comment->status === 'rejected' ? 'bg-red-100 text-red-700' : '' }}">
                                    {{ ucfirst($comment->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-xs text-gray-500 hidden md:table-cell">{{ $comment->created_at->format('M d, Y H:i') }}</td>
                            <td class="px-4 py-3">
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
                            <td colspan="6" class="px-4 py-12 text-center text-gray-400">No comments found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">{{ $comments->links() }}</div>
        </div>
    </div>
</div>
