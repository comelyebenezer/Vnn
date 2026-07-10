<div>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl font-extrabold text-gray-900 dark:text-white">{{ $editMode ? 'Edit Documentary' : 'Create Documentary' }}</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">{{ $editMode ? 'Update the documentary details below' : 'Add a new documentary episode' }}</p>
            </div>
            <a href="{{ route('admin.documentary.index') }}" wire:navigate class="flex items-center gap-2 text-sm text-gray-500 hover:text-vnn-red transition px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Back to Documentaries
            </a>
        </div>
    </x-slot>

    <div class="py-6 px-4 lg:px-6">
        <div class="max-w-7xl mx-auto">
            <form wire:submit="save" class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                {{-- Main Content --}}
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-200 dark:border-gray-800 p-6">
                        <div class="mb-5">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Title</label>
                            <input wire:model="title" type="text" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg px-4 py-3 text-lg font-bold text-gray-900 dark:text-white focus:outline-none focus:border-vnn-red focus:ring-1 focus:ring-vnn-red" placeholder="Documentary title...">
                            @error('title') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-5">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Slug</label>
                            <input wire:model="slug" type="text" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg px-3 py-2.5 text-sm text-gray-700 dark:text-gray-300 focus:outline-none focus:border-vnn-red focus:ring-1 focus:ring-vnn-red" placeholder="documentary-url-slug">
                            @error('slug') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-5">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Excerpt</label>
                            <textarea wire:model="excerpt" rows="3" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg px-3 py-2.5 text-sm text-gray-700 dark:text-gray-300 focus:outline-none focus:border-vnn-red focus:ring-1 focus:ring-vnn-red" placeholder="Brief description of the documentary..."></textarea>
                            @error('excerpt') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Body</label>
                            <div class="border border-gray-300 dark:border-gray-600 rounded-lg" wire:ignore>
                                <div id="ckeditor-container">
                                    <textarea id="ckeditor" class="w-full">{{ $body }}</textarea>
                                </div>
                            </div>
                            @error('body') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                {{-- Sidebar --}}
                <div class="space-y-6">
                    {{-- Status --}}
                    <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-200 dark:border-gray-800 p-6">
                        <h3 class="font-semibold text-gray-900 dark:text-white mb-3">Status</h3>
                        <select wire:model="status" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg px-3 py-2.5 text-sm text-gray-700 dark:text-gray-300 focus:outline-none focus:border-vnn-red">
                            <option value="draft">Draft</option>
                            <option value="pending_review">Pending Review</option>
                            <option value="approved">Approved</option>
                            <option value="published">Published</option>
                            <option value="rejected">Rejected</option>
                        </select>
                        @error('status') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    {{-- YouTube URL --}}
                    <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-200 dark:border-gray-800 p-6">
                        <h3 class="font-semibold text-gray-900 dark:text-white mb-3">YouTube Video</h3>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-600 dark:text-gray-400 mb-1">YouTube URL</label>
                            <input wire:model="youtube_url" type="text" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg px-3 py-2.5 text-sm text-gray-700 dark:text-gray-300 focus:outline-none focus:border-vnn-red focus:ring-1 focus:ring-vnn-red" placeholder="https://www.youtube.com/watch?v=...">
                            @error('youtube_url') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            <p class="text-[11px] text-gray-400 mt-1.5">Paste the full YouTube URL (e.g. <code class="bg-gray-100 dark:bg-gray-800 px-1 rounded">https://www.youtube.com/watch?v=dQw4w9WgXcQ</code>)</p>
                        </div>
                        @if($youtube_url)
                        @php
                            $youtubeId = null;
                            if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/embed\/)([a-zA-Z0-9_-]{11})/', $youtube_url, $m)) {
                                $youtubeId = $m[1];
                            }
                        @endphp
                        @if($youtubeId)
                        <div class="mt-3 rounded-lg overflow-hidden border border-gray-200 dark:border-gray-700">
                            <iframe src="https://www.youtube.com/embed/{{ $youtubeId }}" class="w-full aspect-video" frameborder="0" allow="autoplay; encrypted-media; picture-in-picture" allowfullscreen></iframe>
                        </div>
                        @else
                        <div class="mt-3 bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-3">
                            <p class="text-xs text-yellow-700 dark:text-yellow-300">Could not detect a valid YouTube video. Please check the URL format.</p>
                        </div>
                        @endif
                        @endif
                    </div>

                    {{-- Editor --}}
                    <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-200 dark:border-gray-800 p-6">
                        <h3 class="font-semibold text-gray-900 dark:text-white mb-3">Editor</h3>
                        <select wire:model="editor_id" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg px-3 py-2.5 text-sm text-gray-700 dark:text-gray-300 focus:outline-none focus:border-vnn-red">
                            <option value="">Select editor</option>
                            @foreach($editors as $editor)
                            <option value="{{ $editor->id }}">{{ $editor->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Tags --}}
                    <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-200 dark:border-gray-800 p-6">
                        <h3 class="font-semibold text-gray-900 dark:text-white mb-3">Tags</h3>
                        <div class="flex flex-wrap gap-2 mb-3">
                            @foreach($allTags as $tag)
                            <label class="inline-flex items-center gap-1.5 text-xs bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 px-2.5 py-1.5 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-700 cursor-pointer transition">
                                <input wire:model="tags" type="checkbox" value="{{ $tag->id }}" class="rounded text-vnn-red focus:ring-vnn-red dark:bg-gray-700 dark:border-gray-600">
                                {{ $tag->name }}
                            </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Featured Image --}}
                    <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-200 dark:border-gray-800 p-6">
                        <h3 class="font-semibold text-gray-900 dark:text-white mb-3">Thumbnail</h3>
                        @if($existing_image)
                        <div class="relative mb-3">
                            <img src="{{ asset('storage/' . $existing_image) }}" class="w-full h-36 object-cover rounded-lg border border-gray-200 dark:border-gray-700">
                        </div>
                        @endif
                        <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-4 text-center hover:border-vnn-red transition cursor-pointer" onclick="document.getElementById('featured-image-input').click()">
                            <svg class="w-8 h-8 mx-auto text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <p class="text-xs text-gray-500">Click to upload thumbnail</p>
                            <input id="featured-image-input" wire:model="featured_image" type="file" accept="image/*" class="hidden">
                        </div>
                        @error('featured_image') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    {{-- Options --}}
                    <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-200 dark:border-gray-800 p-6">
                        <h3 class="font-semibold text-gray-900 dark:text-white mb-3">Options</h3>
                        <div class="space-y-3">
                            @foreach([
                                ['model' => 'is_featured', 'label' => 'Featured Documentary'],
                                ['model' => 'is_breaking', 'label' => 'Breaking'],
                                ['model' => 'is_trending', 'label' => 'Trending'],
                                ['model' => 'is_editor_pick', 'label' => "Editor's Pick"],
                                ['model' => 'allow_comments', 'label' => 'Allow Comments'],
                            ] as $opt)
                            <label class="flex items-center gap-3 text-sm text-gray-700 dark:text-gray-300 cursor-pointer p-2 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                                <input wire:model="{{ $opt['model'] }}" type="checkbox" class="rounded text-vnn-red focus:ring-vnn-red dark:bg-gray-700 dark:border-gray-600">
                                {{ $opt['label'] }}
                            </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Submit --}}
                    <button type="submit" class="w-full bg-vnn-red text-white font-bold py-3.5 rounded-xl hover:bg-vnn-red-dark transition shadow-lg shadow-vnn-red/20 flex items-center justify-center gap-2 text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg>
                        {{ $editMode ? 'Update Documentary' : 'Publish Documentary' }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('styles')
    <style>
        .ck-editor__editable { min-height: 600px; }
        .ck-editor { width: 100%; }
        .ck.ck-editor__main > .ck-editor__editable { background-color: var(--ck-color-base-background); }
        .dark .ck.ck-editor__main > .ck-editor__editable { background-color: #1a1a1a; color: #e2e8f0; }
        .dark .ck.ck-toolbar { background-color: #2d2d2d; border-color: #4a5568; }
        .dark .ck.ck-button { color: #e2e8f0; }
        .dark .ck.ck-button:hover { background-color: #4a5568; }
        .dark .ck.ck-dropdown__panel { background-color: #2d2d2d; border-color: #4a5568; }
    </style>
    @endpush

    @push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
    <script>
        document.addEventListener('livewire:init', function () {
            const el = document.querySelector('#ckeditor');
            if (!el) return;

            ClassicEditor.create(el, {
                toolbar: [
                    'heading', '|',
                    'bold', 'italic', 'underline', 'strikethrough', '|',
                    'bulletedList', 'numberedList', '|',
                    'outdent', 'indent', '|',
                    'link', 'blockQuote', 'insertTable', 'mediaEmbed', '|',
                    'imageUpload', '|',
                    'undo', 'redo'
                ],
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                        { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                    ]
                },
                mediaEmbed: { previewsInData: true }
            }).then(editor => {
                window.LivewireCkEditor = editor;

                const wireEl = document.querySelector('[wire\\:id]');
                const componentId = wireEl ? wireEl.getAttribute('wire:id') : null;

                editor.model.document.on('change:data', () => {
                    try {
                        if (componentId) {
                            Livewire.find(componentId).set('body', editor.getData());
                        }
                    } catch (e) {
                        console.warn('Livewire sync skipped:', e);
                    }
                });
            }).catch(err => {
                console.error('CKEditor error:', err);
            });
        });
    </script>
    @endpush
</div>
