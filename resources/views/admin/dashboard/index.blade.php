<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-vnn-blue leading-tight">Admin Dashboard</h2>
            <span class="text-sm text-gray-500">{{ now()->format('l, F j, Y') }}</span>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-lg shadow-sm border-l-4 border-vnn-blue p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total Articles</p>
                            <p class="text-3xl font-bold text-vnn-blue">{{ \App\Models\Article::count() }}</p>
                        </div>
                        <div class="w-12 h-12 bg-vnn-blue/10 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-vnn-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                        </div>
                    </div>
                    <div class="mt-2">
                        <a href="{{ route('admin.articles.index') }}" class="text-xs text-vnn-blue hover:underline">Manage Articles →</a>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm border-l-4 border-green-500 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Published</p>
                            <p class="text-3xl font-bold text-green-600">{{ \App\Models\Article::where('status', 'published')->count() }}</p>
                        </div>
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm border-l-4 border-yellow-500 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Pending Review</p>
                            <p class="text-3xl font-bold text-yellow-600">{{ \App\Models\Article::where('status', 'pending_review')->count() }}</p>
                        </div>
                        <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm border-l-4 border-vnn-red p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total Views</p>
                            <p class="text-3xl font-bold text-vnn-red">{{ number_format(\App\Models\Article::sum('view_count')) }}</p>
                        </div>
                        <div class="w-12 h-12 bg-vnn-red/10 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-vnn-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Recent Articles --}}
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h3 class="font-semibold text-vnn-blue">Recent Articles</h3>
                </div>
                <div class="p-6">
                    @php $recent = \App\Models\Article::with('author')->latest()->take(5)->get(); @endphp
                    @if($recent->count())
                    <div class="space-y-3">
                        @foreach($recent as $art)
                        <div class="flex items-center justify-between py-2 border-b border-gray-50 last:border-0">
                            <div class="flex items-center gap-3">
                                <span class="text-xs text-gray-400 w-16">{{ $art->created_at->format('M d') }}</span>
                                <span class="text-sm font-medium text-gray-700">{{ \Illuminate\Support\Str::limit($art->title, 60) }}</span>
                            </div>
                            <span class="text-xs text-gray-400">{{ $art->author?->name ?? '—' }}</span>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <p class="text-gray-400 text-sm text-center py-4">No articles yet. <a href="{{ route('admin.articles.create') }}" class="text-vnn-red hover:underline">Create one</a>.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
