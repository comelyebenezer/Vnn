<div>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-vnn-blue leading-tight">Subscribers</h2>
            <button class="bg-gray-500 text-white text-sm font-bold px-4 py-2 rounded opacity-50 cursor-not-allowed" disabled>Export</button>
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
                        <input wire:model.live="search" type="text" placeholder="Search subscribers..." class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
                    </div>
                    <div>
                        <select wire:model.live="status" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
                            <option value="">All Statuses</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                            <option value="unsubscribed">Unsubscribed</option>
                        </select>
                    </div>
                    <div class="text-sm text-gray-500 flex items-center">
                        Showing {{ $subscribers->firstItem() }}-{{ $subscribers->lastItem() }} of {{ $subscribers->total() }}
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="text-left px-4 py-3 font-semibold text-gray-600">Email</th>
                            <th class="text-left px-4 py-3 font-semibold text-gray-600 hidden md:table-cell">Name</th>
                            <th wire:click="sortBy('status')" class="text-left px-4 py-3 font-semibold text-gray-600 cursor-pointer hover:text-vnn-blue">Status</th>
                            <th class="text-left px-4 py-3 font-semibold text-gray-600 hidden md:table-cell">Verified</th>
                            <th class="text-left px-4 py-3 font-semibold text-gray-600 hidden lg:table-cell">Subscribed</th>
                            <th class="px-4 py-3 font-semibold text-gray-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($subscribers as $sub)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 font-medium text-gray-700">{{ $sub->email }}</td>
                            <td class="px-4 py-3 text-gray-500 hidden md:table-cell text-xs">{{ $sub->name ?: 'N/A' }}</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-0.5 rounded text-xs font-semibold {{ $sub->status === 'active' ? 'bg-green-100 text-green-700' : ($sub->status === 'inactive' ? 'bg-gray-100 text-gray-600' : 'bg-red-100 text-red-700') }}">
                                    {{ ucfirst($sub->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-0.5 rounded text-xs font-semibold {{ $sub->is_verified ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                    {{ $sub->is_verified ? 'Yes' : 'No' }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-gray-500 hidden lg:table-cell text-xs">{{ $sub->created_at->format('M d, Y') }}</td>
                            <td class="px-4 py-3">
                                <button wire:click="deleteSubscriber({{ $sub->id }})" class="text-red-500 hover:text-red-700 text-xs font-semibold" onclick="return confirm('Delete this subscriber?')">Delete</button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-4 py-12 text-center text-gray-400">No subscribers found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">{{ $subscribers->links() }}</div>
        </div>
    </div>
</div>
