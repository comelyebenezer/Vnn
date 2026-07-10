<div>
    <h3 class="text-xl font-bold text-vnn-dark dark:text-white mb-6 font-heading">Comments</h3>

    @if($success)
    <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg flex items-center gap-3">
        <svg class="w-5 h-5 text-green-600 dark:text-green-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <p class="text-sm text-green-700 dark:text-green-300 font-body">Your comment has been submitted and is awaiting moderation.</p>
    </div>
    @endif

    <form wire:submit="submit" class="mb-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-3">
            <div>
                <input wire:model="guestName" type="text" placeholder="Your name *" class="w-full border border-gray-300 dark:border-gray-600 rounded px-3 py-2.5 text-sm bg-white dark:bg-vnn-dark dark:text-white focus:outline-none focus:border-vnn-red font-body">
                @error('guestName') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <input wire:model="guestEmail" type="email" placeholder="Your email *" class="w-full border border-gray-300 dark:border-gray-600 rounded px-3 py-2.5 text-sm bg-white dark:bg-vnn-dark dark:text-white focus:outline-none focus:border-vnn-red font-body">
                @error('guestEmail') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>
        <div class="mb-3">
            <input wire:model="guestWebsite" type="url" placeholder="Website (optional)" class="w-full border border-gray-300 dark:border-gray-600 rounded px-3 py-2.5 text-sm bg-white dark:bg-vnn-dark dark:text-white focus:outline-none focus:border-vnn-red font-body">
            @error('guestWebsite') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
        <textarea wire:model="body" rows="4" placeholder="Share your thoughts..." class="w-full border border-gray-300 dark:border-gray-600 rounded p-4 text-sm bg-white dark:bg-vnn-dark dark:text-white focus:outline-none focus:border-vnn-red font-body"></textarea>
        @error('body') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        <button type="submit" class="mt-2 bg-vnn-red text-white text-sm font-bold px-6 py-2.5 rounded hover:bg-vnn-red-dark transition font-heading">Post Comment</button>
    </form>

    @if($article->comments->where('status', 'approved')->count())
        <div class="space-y-4">
            @foreach($article->comments->where('status', 'approved') as $comment)
                <div class="flex gap-3 p-4 bg-vnn-gray dark:bg-vnn-dark-light rounded">
                    <div class="w-8 h-8 bg-gray-300 dark:bg-gray-600 rounded-full shrink-0"></div>
                    <div>
                        <span class="font-semibold text-sm text-gray-700 dark:text-gray-200">{{ $comment->user?->name ?? $comment->guest_name ?? 'Anonymous' }}</span>
                        @if($comment->guest_website)
                        <a href="{{ $comment->guest_website }}" target="_blank" rel="noopener noreferrer" class="text-xs text-vnn-red hover:underline ml-1">Website</a>
                        @endif
                        <span class="text-xs text-gray-400 ml-2">{{ $comment->created_at->diffForHumans() }}</span>
                        <p class="text-sm text-gray-600 dark:text-gray-300 mt-1 font-body">{{ $comment->body }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-400 dark:text-gray-500 text-sm font-body">No comments yet. Be the first to comment!</p>
    @endif
</div>
