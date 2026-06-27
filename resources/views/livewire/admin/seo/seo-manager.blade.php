<div>
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <h3 class="font-semibold text-vnn-blue">Search Engine Optimization</h3>
        </div>

        <form wire:submit="save" class="p-6 space-y-6">
            {{-- Standard Meta --}}
            <div>
                <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4">Standard Meta</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Meta Title</label>
                        <input wire:model="meta_title" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:border-vnn-blue focus:outline-none" maxlength="70">
                        <p class="text-xs text-gray-400 mt-1">Recommended: 50-60 characters (<span x-text="$wire.meta_title.length"></span>/70)</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Meta Description</label>
                        <textarea wire:model="meta_description" rows="2" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:border-vnn-blue focus:outline-none" maxlength="160"></textarea>
                        <p class="text-xs text-gray-400 mt-1">Recommended: 150-160 characters (<span x-text="$wire.meta_description.length"></span>/160)</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Keywords</label>
                        <input wire:model="keywords" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:border-vnn-blue focus:outline-none" placeholder="news, nigeria, politics, ...">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Canonical URL</label>
                        <input wire:model="canonical_url" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:border-vnn-blue focus:outline-none" placeholder="https://vervenews.ng/article/slug">
                    </div>
                </div>
            </div>

            {{-- Open Graph --}}
            <div>
                <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4">Open Graph (Facebook, LinkedIn, WhatsApp)</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">OG Title</label>
                        <input wire:model="og_title" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:border-vnn-blue focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">OG Description</label>
                        <textarea wire:model="og_description" rows="2" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:border-vnn-blue focus:outline-none"></textarea>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">OG Image URL</label>
                        <input wire:model="og_image" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:border-vnn-blue focus:outline-none" placeholder="https:// or storage path">
                        @if($og_image)
                        <div class="mt-2">
                            <img src="{{ \Illuminate\Support\Str::startsWith($og_image, 'http') ? $og_image : asset('storage/' . $og_image) }}" class="w-48 h-24 object-cover rounded border">
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Twitter Card --}}
            <div>
                <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4">Twitter Card</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Card Type</label>
                        <select wire:model="twitter_card" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:border-vnn-blue focus:outline-none">
                            <option value="summary_large_image">Summary Large Image</option>
                            <option value="summary">Summary</option>
                            <option value="app">App</option>
                            <option value="player">Player</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Twitter Title</label>
                        <input wire:model="twitter_title" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:border-vnn-blue focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Twitter Description</label>
                        <textarea wire:model="twitter_description" rows="2" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:border-vnn-blue focus:outline-none"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Twitter Image URL</label>
                        <input wire:model="twitter_image" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:border-vnn-blue focus:outline-none" placeholder="https:// or storage path">
                    </div>
                </div>
            </div>

            {{-- Schema Markup --}}
            <div>
                <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4">Schema.org Structured Data (JSON-LD)</h4>
                <textarea wire:model="schema_markup" rows="6" class="w-full border border-gray-300 rounded px-3 py-2 text-sm font-mono focus:border-vnn-blue focus:outline-none" placeholder='{"@context": "https://schema.org", "@type": "NewsArticle", ...}'></textarea>
                <p class="text-xs text-gray-400 mt-1">Paste valid JSON-LD schema markup. Preview available after saving.</p>
            </div>

            {{-- Actions --}}
            <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                <button type="submit" class="bg-vnn-blue text-white px-6 py-2.5 rounded text-sm font-semibold hover:bg-vnn-blue-dark transition">
                    Save SEO Metadata
                </button>
            </div>
        </form>
    </div>
</div>
