<div>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl font-extrabold text-gray-900 dark:text-white">News Ticker</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">Manage the scrolling news ticker under the navigation bar</p>
            </div>
            <a href="{{ route('admin.ticker.create') }}" class="bg-vnn-red text-white font-bold px-4 py-2 rounded-lg text-sm hover:bg-vnn-red-dark transition flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Add Ticker Item
            </a>
        </div>
    </x-slot>

    <div class="py-6 px-4 lg:px-6">
        @if(session('message'))
        <div class="mb-4 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 rounded-lg p-3 text-sm text-green-700 dark:text-green-300">
            {{ session('message') }}
        </div>
        @endif

        <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-200 dark:border-gray-800 overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 dark:bg-gray-800 text-gray-500 dark:text-gray-400 text-xs uppercase tracking-wider">
                    <tr>
                        <th class="text-left px-6 py-3">Order</th>
                        <th class="text-left px-6 py-3">Icon</th>
                        <th class="text-left px-6 py-3">Text</th>
                        <th class="text-left px-6 py-3">Status</th>
                        <th class="text-right px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    @forelse($tickers as $ticker)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50">
                        <td class="px-6 py-4 text-gray-500 dark:text-gray-400">{{ $ticker->sort_order }}</td>
                        <td class="px-6 py-4 text-lg">{{ $ticker->icon }}</td>
                        <td class="px-6 py-4 text-gray-900 dark:text-white font-medium">{{ $ticker->text }}</td>
                        <td class="px-6 py-4">
                            <button wire:click="toggleActive({{ $ticker->id }})" class="px-2 py-0.5 rounded-full text-xs font-bold {{ $ticker->is_active ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : 'bg-gray-100 text-gray-500 dark:bg-gray-800 dark:text-gray-400' }}">
                                {{ $ticker->is_active ? 'Active' : 'Inactive' }}
                            </button>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.ticker.edit', $ticker->id) }}" class="text-vnn-red hover:underline text-xs font-bold">Edit</a>
                                <button wire:click="deleteTicker({{ $ticker->id }})" wire:confirm="Delete this ticker item?" class="text-red-500 hover:underline text-xs font-bold">Delete</button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-400 dark:text-gray-500">
                            No ticker items yet. Add one to get started.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="px-6 py-3 border-t border-gray-100 dark:border-gray-800">
                {{ $tickers->links() }}
            </div>
        </div>
    </div>
</div>
