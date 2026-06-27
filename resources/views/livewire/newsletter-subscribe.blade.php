<div>
    @if($success)
        <p class="text-green-400 text-xs font-semibold">{{ $message }}</p>
    @elseif($layout === 'vertical')
        <form wire:submit="subscribe" class="mt-4">
            <input wire:model="email" type="email" placeholder="Enter your email" class="w-full px-4 py-2.5 rounded text-sm text-gray-900 mb-2 focus:outline-none focus:ring-2 focus:ring-vnn-red font-body" required>
            <button type="submit" class="w-full bg-vnn-red text-white font-bold py-2.5 rounded text-sm hover:bg-vnn-red-dark transition active:scale-[0.98] font-heading">Subscribe Now</button>
            @error('email') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
        </form>
    @else
        <form wire:submit="subscribe" class="flex gap-1">
            <input wire:model="email" type="email" placeholder="Your email" class="flex-1 px-3 py-2 text-xs text-gray-900 rounded border-0 focus:outline-none focus:ring-1 focus:ring-vnn-red font-body" required>
            <button type="submit" class="bg-vnn-red text-white px-3 py-2 text-xs font-bold rounded hover:bg-vnn-red-dark transition">Subscribe</button>
            @error('email') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
        </form>
    @endif
</div>
