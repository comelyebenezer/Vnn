<div>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-vnn-blue leading-tight">Authors</h2>
            <a href="{{ route('admin.authors.create') }}" class="bg-vnn-red text-white text-sm font-bold px-4 py-2 rounded hover:bg-vnn-red-dark transition">+ New Author</a>
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
                        <input wire:model.live="search" type="text" placeholder="Search authors..." class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
                    </div>
                    <div></div>
                    <div class="text-sm text-gray-500 flex items-center">
                        Showing {{ $authors->firstItem() }}-{{ $authors->lastItem() }} of {{ $authors->total() }}
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="text-left px-4 py-3 font-semibold text-gray-600">User</th>
                            <th class="text-left px-4 py-3 font-semibold text-gray-600 hidden md:table-cell">Expertise</th>
                            <th class="text-left px-4 py-3 font-semibold text-gray-600">Featured</th>
                            <th class="px-4 py-3 font-semibold text-gray-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($authors as $author)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">
                                <a href="{{ route('admin.authors.edit', $author) }}" class="font-medium text-vnn-blue hover:text-vnn-red transition">{{ $author->user?->name ?? 'Unknown' }}</a>
                            </td>
                            <td class="px-4 py-3 text-gray-500 hidden md:table-cell text-xs">{{ $author->expertise ?: 'N/A' }}</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-0.5 rounded text-xs font-semibold {{ $author->is_featured ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                    {{ $author->is_featured ? 'Featured' : 'Standard' }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.authors.edit', $author) }}" class="text-vnn-blue hover:text-vnn-red text-xs font-semibold">Edit</a>
                                    <button wire:click="deleteAuthor({{ $author->id }})" class="text-red-500 hover:text-red-700 text-xs font-semibold" onclick="return confirm('Delete this author?')">Delete</button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-4 py-12 text-center text-gray-400">No authors found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">{{ $authors->links() }}</div>
        </div>
    </div>
</div>
