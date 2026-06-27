<div>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-vnn-blue leading-tight">Publishers</h2>
            <a href="{{ route('admin.publishers.create') }}" class="bg-vnn-red text-white text-sm font-bold px-4 py-2 rounded hover:bg-vnn-red-dark transition">+ New Publisher</a>
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
                        <input wire:model.live="search" type="text" placeholder="Search publishers..." class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
                    </div>
                    <div></div>
                    <div class="text-sm text-gray-500 flex items-center">
                        Showing {{ $publishers->firstItem() }}-{{ $publishers->lastItem() }} of {{ $publishers->total() }}
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="text-left px-4 py-3 font-semibold text-gray-600">User</th>
                            <th class="text-left px-4 py-3 font-semibold text-gray-600 hidden md:table-cell">Signature</th>
                            <th class="px-4 py-3 font-semibold text-gray-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($publishers as $publisher)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">
                                <a href="{{ route('admin.publishers.edit', $publisher) }}" class="font-medium text-vnn-blue hover:text-vnn-red transition">{{ $publisher->user?->name ?? 'Unknown' }}</a>
                            </td>
                            <td class="px-4 py-3 text-gray-500 hidden md:table-cell text-xs">{{ $publisher->signature ?: 'N/A' }}</td>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.publishers.edit', $publisher) }}" class="text-vnn-blue hover:text-vnn-red text-xs font-semibold">Edit</a>
                                    <button wire:click="deletePublisher({{ $publisher->id }})" class="text-red-500 hover:text-red-700 text-xs font-semibold" onclick="return confirm('Delete this publisher?')">Delete</button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-4 py-12 text-center text-gray-400">No publishers found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">{{ $publishers->links() }}</div>
        </div>
    </div>
</div>
