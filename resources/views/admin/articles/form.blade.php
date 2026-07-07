<div>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl font-extrabold text-gray-900 dark:text-white">{{ $editMode ? 'Edit News' : 'Create News' }}</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">{{ $editMode ? 'Update the article details below' : 'Write a new news article' }}</p>
            </div>
            <a href="{{ route('admin.articles.index') }}" wire:navigate class="flex items-center gap-2 text-sm text-gray-500 hover:text-vnn-red transition px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Back to News
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
                            <input wire:model="title" type="text" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg px-4 py-3 text-lg font-bold text-gray-900 dark:text-white focus:outline-none focus:border-vnn-red focus:ring-1 focus:ring-vnn-red" placeholder="News headline...">
                            @error('title') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-5">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Slug</label>
                            <input wire:model="slug" type="text" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg px-3 py-2.5 text-sm text-gray-700 dark:text-gray-300 focus:outline-none focus:border-vnn-red focus:ring-1 focus:ring-vnn-red" placeholder="article-url-slug">
                            @error('slug') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-5">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Excerpt</label>
                            <textarea wire:model="excerpt" rows="3" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg px-3 py-2.5 text-sm text-gray-700 dark:text-gray-300 focus:outline-none focus:border-vnn-red focus:ring-1 focus:ring-vnn-red" placeholder="Brief summary of the news..."></textarea>
                            @error('excerpt') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Body</label>
                            <div class="border border-gray-300 dark:border-gray-600 rounded-lg overflow-hidden" wire:ignore>
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
                            <option value="fact_checking">Fact Checking</option>
                            <option value="approved">Approved</option>
                            <option value="scheduled">Scheduled</option>
                            <option value="published">Published</option>
                            <option value="rejected">Rejected</option>
                        </select>
                        @error('status') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror

                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Schedule Date</label>
                            <input wire:model="scheduled_date" type="datetime-local" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg px-3 py-2.5 text-sm text-gray-700 dark:text-gray-300 focus:outline-none focus:border-vnn-red">
                        </div>
                    </div>

                    {{-- Categories --}}
                    <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-200 dark:border-gray-800 p-6">
                        <h3 class="font-semibold text-gray-900 dark:text-white mb-3">Categories</h3>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-600 dark:text-gray-400 mb-1">Primary Category</label>
                            <select wire:model.live="category_id" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg px-3 py-2.5 text-sm text-gray-700 dark:text-gray-300 focus:outline-none focus:border-vnn-red">
                                <option value="">Select category</option>
                                @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 dark:text-gray-400 mb-1">Subcategory</label>
                            <select wire:model="subcategory_id" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg px-3 py-2.5 text-sm text-gray-700 dark:text-gray-300 focus:outline-none focus:border-vnn-red">
                                <option value="">Select subcategory</option>
                                @foreach($subcategories as $sub)
                                <option value="{{ $sub->id }}">{{ $sub->name }}</option>
                                @endforeach
                            </select>
                        </div>
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
                        <h3 class="font-semibold text-gray-900 dark:text-white mb-3">Featured Image</h3>
                        @if($existing_image)
                        <div class="relative mb-3">
                            <img src="{{ asset('storage/' . $existing_image) }}" class="w-full h-36 object-cover rounded-lg border border-gray-200 dark:border-gray-700">
                        </div>
                        @endif
                        <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-4 text-center hover:border-vnn-red transition cursor-pointer" onclick="document.getElementById('featured-image-input').click()">
                            <svg class="w-8 h-8 mx-auto text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <p class="text-xs text-gray-500">Click to upload image</p>
                            <input id="featured-image-input" wire:model="featured_image" type="file" accept="image/*" class="hidden">
                        </div>
                        @error('featured_image') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        <div id="upload-notification" class="mt-3 hidden">
                            <div class="bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 rounded-lg p-3 flex items-center gap-2">
                                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <span id="upload-notification-text" class="text-sm text-green-700 dark:text-green-300"></span>
                            </div>
                        </div>
                        <div class="mt-3">
                            <input wire:model="image_caption" type="text" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg px-3 py-2.5 text-sm text-gray-700 dark:text-gray-300 focus:outline-none focus:border-vnn-red" placeholder="Image caption">
                        </div>
                    </div>

                    {{-- Options --}}
                    <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-200 dark:border-gray-800 p-6">
                        <h3 class="font-semibold text-gray-900 dark:text-white mb-3">Options</h3>
                        <div class="space-y-3">
                            @foreach([
                                ['model' => 'is_featured', 'label' => 'Featured News'],
                                ['model' => 'is_breaking', 'label' => 'Breaking News'],
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

                    @if(property_exists($this, 'youtube_url'))
                    {{-- YouTube Video --}}
                    <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-200 dark:border-gray-800 p-6">
                        <h3 class="font-semibold text-gray-900 dark:text-white mb-3">YouTube Video</h3>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-600 dark:text-gray-400 mb-1">YouTube URL</label>
                            <input wire:model="youtube_url" type="url" class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 rounded-lg px-3 py-2.5 text-sm text-gray-700 dark:text-gray-300 focus:outline-none focus:border-vnn-red focus:ring-1 focus:ring-vnn-red" placeholder="https://www.youtube.com/watch?v=...">
                            @error('youtube_url') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        @if($youtube_url)
                        <div class="mt-3 rounded-lg overflow-hidden border border-gray-200 dark:border-gray-700">
                            <div class="aspect-video bg-gray-100 dark:bg-gray-800 flex items-center justify-center">
                                <p class="text-xs text-gray-500 dark:text-gray-400 px-3 text-center">Preview available after saving</p>
                            </div>
                        </div>
                        @endif
                    </div>
                    @endif

                    @if(property_exists($this, 'media_file'))
                    {{-- Video Upload --}}
                    <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-200 dark:border-gray-800 p-6">
                        <h3 class="font-semibold text-gray-900 dark:text-white mb-3">Video Upload</h3>

                        @if($existing_media && !$remove_media)
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-600 dark:text-gray-400 mb-2">Current Video</label>
                            <div class="relative rounded-lg overflow-hidden border border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-800">
                                <video src="{{ asset('storage/' . $existing_media) }}" controls class="w-full max-h-64 object-contain"></video>
                                <button type="button" wire:click="removeExistingMedia" class="absolute top-2 right-2 bg-red-500 text-white text-xs px-2 py-1 rounded-lg hover:bg-red-600 transition shadow">Remove</button>
                            </div>
                        </div>
                        @else
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-600 dark:text-gray-400 mb-1">Upload Video File</label>
                            <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-6 text-center hover:border-vnn-red transition cursor-pointer" wire:click="$refs.videoInput.click()">
                                <svg class="w-8 h-8 mx-auto text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Click to upload or drag and drop</p>
                                <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">MP4, WebM, OGG (max 100MB)</p>
                            </div>
                            <input wire:model="media_file" x-ref="videoInput" type="file" accept="video/mp4,video/webm,video/ogg" class="hidden">
                        </div>
                        @if($media_file)
                        <div class="mt-3 rounded-lg overflow-hidden border border-gray-200 dark:border-gray-700">
                            <video wire:model="media_file" controls class="w-full max-h-64 object-contain"></video>
                        </div>
                        @error('media_file') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        @endif
                        @endif
                    </div>
                    @endif

                    {{-- Submit --}}
                    <button type="submit" class="w-full bg-vnn-red text-white font-bold py-3.5 rounded-xl hover:bg-vnn-red-dark transition shadow-lg shadow-vnn-red/20 flex items-center justify-center gap-2 text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg>
                        {{ $editMode ? 'Update News' : 'Publish News' }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('styles')
    <style>
        .ck-editor__editable { min-height: 450px; }
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
