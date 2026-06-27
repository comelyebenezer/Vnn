<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-vnn-dark dark:text-white leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <span class="text-sm text-gray-500">{{ now()->format('l, F j, Y') }}</span>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Stats Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border-l-4 border-vnn-red p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Articles</p>
                            <p class="text-3xl font-bold text-vnn-dark dark:text-white">0</p>
                        </div>
                        <div class="w-12 h-12 bg-vnn-red/10 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-vnn-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border-l-4 border-green-500 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Published</p>
                            <p class="text-3xl font-bold text-green-600">0</p>
                        </div>
                        <div class="w-12 h-12 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border-l-4 border-blue-500 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Views</p>
                            <p class="text-3xl font-bold text-blue-600">0</p>
                        </div>
                        <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border-l-4 border-yellow-500 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Subscribers</p>
                            <p class="text-3xl font-bold text-yellow-600">0</p>
                        </div>
                        <div class="w-12 h-12 bg-yellow-100 dark:bg-yellow-900/30 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Welcome Card --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold text-vnn-dark dark:text-white mb-4">Welcome to VNN Dashboard</h3>
                    <p class="text-gray-600 dark:text-gray-400">You're logged in as <strong class="text-vnn-red">{{ auth()->user()->name }}</strong>. Use the navigation menu to manage your content.</p>
                    <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                        <a href="{{ route('login') }}" class="block p-4 bg-vnn-red/5 border border-vnn-red/20 rounded-lg hover:bg-vnn-red/10 transition">
                            <h4 class="font-semibold text-vnn-red text-sm uppercase tracking-wide">Articles</h4>
                            <p class="text-xs text-gray-500 mt-1">Create and manage news articles</p>
                        </a>
                        <a href="#" class="block p-4 bg-vnn-red/5 border border-vnn-red/20 rounded-lg hover:bg-vnn-red/10 transition">
                            <h4 class="font-semibold text-vnn-red text-sm uppercase tracking-wide">Categories</h4>
                            <p class="text-xs text-gray-500 mt-1">Organize content by category</p>
                        </a>
                        <a href="#" class="block p-4 bg-vnn-red/5 border border-vnn-red/20 rounded-lg hover:bg-vnn-red/10 transition">
                            <h4 class="font-semibold text-vnn-red text-sm uppercase tracking-wide">Media</h4>
                            <p class="text-xs text-gray-500 mt-1">Upload and manage media files</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>