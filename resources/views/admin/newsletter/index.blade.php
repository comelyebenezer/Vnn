<div>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-vnn-blue leading-tight">Newsletters</h2>
            <a href="{{ route('admin.newsletter.create') }}" class="bg-vnn-red text-white text-sm font-bold px-4 py-2 rounded hover:bg-vnn-red-dark transition">+ New Newsletter</a>
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
                        <input wire:model.live="search" type="text" placeholder="Search newsletters..." class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
                    </div>
                    <div>
                        <select wire:model.live="status" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
                            <option value="">All Statuses</option>
                            <option value="draft">Draft</option>
                            <option value="sent">Sent</option>
                            <option value="scheduled">Scheduled</option>
                        </select>
                    </div>
                    <div class="text-sm text-gray-500 flex items-center">
                        Showing {{ $newsletters->firstItem() }}-{{ $newsletters->lastItem() }} of {{ $newsletters->total() }}
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th wire:click="sortBy('subject')" class="text-left px-4 py-3 font-semibold text-gray-600 cursor-pointer hover:text-vnn-blue">Subject</th>
                            <th wire:click="sortBy('status')" class="text-left px-4 py-3 font-semibold text-gray-600 cursor-pointer hover:text-vnn-blue">Status</th>
                            <th class="text-left px-4 py-3 font-semibold text-gray-600 hidden md:table-cell">Sent At</th>
                            <th class="text-left px-4 py-3 font-semibold text-gray-600 hidden md:table-cell">Recipients</th>
                            <th class="px-4 py-3 font-semibold text-gray-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($newsletters as $nl)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">
                                <a href="{{ route('admin.newsletter.edit', $nl) }}" class="font-medium text-vnn-blue hover:text-vnn-red transition">{{ $nl->subject }}</a>
                            </td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-0.5 rounded text-xs font-semibold {{ $nl->status === 'sent' ? 'bg-green-100 text-green-700' : ($nl->status === 'scheduled' ? 'bg-blue-100 text-blue-700' : 'bg-gray-100 text-gray-600') }}">
                                    {{ ucfirst($nl->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-gray-500 hidden md:table-cell text-xs">{{ $nl->sent_at ? $nl->sent_at->format('M d, Y H:i') : 'N/A' }}</td>
                            <td class="px-4 py-3 text-gray-500 hidden md:table-cell text-xs">{{ number_format($nl->total_recipients) }}</td>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.newsletter.edit', $nl) }}" class="text-vnn-blue hover:text-vnn-red text-xs font-semibold">Edit</a>
                                    <button wire:click="deleteNewsletter({{ $nl->id }})" class="text-red-500 hover:text-red-700 text-xs font-semibold" onclick="return confirm('Delete this newsletter?')">Delete</button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-4 py-12 text-center text-gray-400">No newsletters found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">{{ $newsletters->links() }}</div>
        </div>
    </div>
</div>
