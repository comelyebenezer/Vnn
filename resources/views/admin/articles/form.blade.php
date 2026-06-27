<div>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-vnn-blue leading-tight">{{ $editMode ? 'Edit Article' : 'Create Article' }}</h2>
            <a href="{{ route('admin.articles.index') }}" class="text-sm text-gray-500 hover:text-vnn-blue transition">← Back to Articles</a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form wire:submit="save" class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                {{-- Main Content --}}
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <div class="mb-4">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Title</label>
                            <input wire:model="title" type="text" class="w-full border border-gray-300 rounded-lg px-4 py-3 text-lg font-bold focus:outline-none focus:border-vnn-blue" placeholder="Article headline...">
                            @error('title') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Slug</label>
                            <input wire:model="slug" type="text" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-vnn-blue" placeholder="article-url-slug">
                            @error('slug') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Excerpt</label>
                            <textarea wire:model="excerpt" rows="3" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-vnn-blue" placeholder="Brief summary of the article..."></textarea>
                            @error('excerpt') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Body</label>
                            <div class="border border-gray-300 rounded-lg overflow-hidden" wire:ignore>
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
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <h3 class="font-semibold text-gray-700 mb-3">Status</h3>
                        <select wire:model="status" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
                            <option value="draft">Draft</option>
                            <option value="pending_review">Pending Review</option>
                            <option value="fact_checking">Fact Checking</option>
                            <option value="approved">Approved</option>
                            <option value="scheduled">Scheduled</option>
                            <option value="published">Published</option>
                            <option value="rejected">Rejected</option>
                        </select>
                        @error('status') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror

                        <div class="mt-3" x-data="{ open: false, date: '' }">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Schedule Date</label>
                            <input wire:model="scheduled_date" type="datetime-local" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
                        </div>
                    </div>

                    {{-- Categories --}}
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <h3 class="font-semibold text-gray-700 mb-3">Categories</h3>
                        <div class="mb-3">
                            <label class="block text-sm text-gray-600 mb-1">Primary Category</label>
                            <select wire:model.live="category_id" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
                                <option value="">Select category</option>
                                @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm text-gray-600 mb-1">Subcategory</label>
                            <select wire:model="subcategory_id" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
                                <option value="">Select subcategory</option>
                                @foreach($subcategories as $sub)
                                <option value="{{ $sub->id }}">{{ $sub->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Tags --}}
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <h3 class="font-semibold text-gray-700 mb-3">Tags</h3>
                        <div class="flex flex-wrap gap-2 mb-3">
                            @foreach($allTags as $tag)
                            <label class="inline-flex items-center gap-1 text-xs bg-gray-100 px-2 py-1 rounded hover:bg-gray-200 cursor-pointer">
                                <input wire:model="tags" type="checkbox" value="{{ $tag->id }}" class="rounded text-vnn-red focus:ring-vnn-red">
                                {{ $tag->name }}
                            </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Featured Image --}}
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <h3 class="font-semibold text-gray-700 mb-3">Featured Image</h3>
                        @if($existing_image)
                        <img src="{{ asset('storage/' . $existing_image) }}" class="w-full h-32 object-cover rounded mb-2">
                        @endif
                        <input wire:model="featured_image" type="file" accept="image/*" class="w-full text-sm">
                        @error('featured_image') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        <div class="mt-2">
                            <input wire:model="image_caption" type="text" class="w-full border border-gray-300 rounded px-3 py-2 text-sm" placeholder="Image caption">
                        </div>
                    </div>

                    {{-- Options --}}
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <h3 class="font-semibold text-gray-700 mb-3">Options</h3>
                        <div class="space-y-2">
                            <label class="flex items-center gap-2 text-sm">
                                <input wire:model="is_featured" type="checkbox" class="rounded text-vnn-red focus:ring-vnn-red">
                                Featured Article
                            </label>
                            <label class="flex items-center gap-2 text-sm">
                                <input wire:model="is_breaking" type="checkbox" class="rounded text-vnn-red focus:ring-vnn-red">
                                Breaking News
                            </label>
                            <label class="flex items-center gap-2 text-sm">
                                <input wire:model="is_trending" type="checkbox" class="rounded text-vnn-red focus:ring-vnn-red">
                                Trending
                            </label>
                            <label class="flex items-center gap-2 text-sm">
                                <input wire:model="is_editor_pick" type="checkbox" class="rounded text-vnn-red focus:ring-vnn-red">
                                Editor's Pick
                            </label>
                            <label class="flex items-center gap-2 text-sm">
                                <input wire:model="allow_comments" type="checkbox" class="rounded text-vnn-red focus:ring-vnn-red">
                                Allow Comments
                            </label>
                        </div>
                    </div>

                    {{-- Submit --}}
                    <button type="submit" class="w-full bg-vnn-red text-white font-bold py-3 rounded-lg hover:bg-vnn-red-dark transition">
                        {{ $editMode ? 'Update Article' : 'Create Article' }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('styles')
    <style>
        .ck-editor__editable { min-height: 400px; }
    </style>
    @endpush

    @push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
    <script>
        document.addEventListener('livewire:init', function () {
            let editor;

            ClassicEditor
                .create(document.querySelector('#ckeditor'), {
                    toolbar: {
                        items: [
                            'heading', '|',
                            'bold', 'italic', 'underline', 'strikethrough', '|',
                            'bulletedList', 'numberedList', '|',
                            'outdent', 'indent', '|',
                            'link', 'blockQuote', 'insertTable', 'mediaEmbed', '|',
                            'imageUpload', '|',
                            'undo', 'redo', '|',
                            'sourceEditing'
                        ]
                    },
                    heading: {
                        options: [
                            { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                            { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                            { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                            { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                            { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                        ]
                    },
                    mediaEmbed: {
                        previewsInData: true
                    }
                })
                .then(newEditor => {
                    editor = newEditor;
                    editor.model.document.on('change:data', () => {
                        @this.set('body', editor.getData());
                    });
                })
                .catch(error => {
                    console.error(error);
                });

            Livewire.on('article-saved', () => {
                if (editor) {
                    editor.setData('');
                }
            });
        });
    </script>
    @endpush
</div>
