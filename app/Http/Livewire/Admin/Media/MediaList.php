<?php

namespace App\Http\Livewire\Admin\Media;

use App\Models\Media;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class MediaList extends Component
{
    use WithPagination;

    public $search = '';
    public $mime_type = '';

    protected $queryString = ['search', 'mime_type'];

    public function deleteMedia($id)
    {
        $media = Media::findOrFail($id);
        Storage::disk($media->disk)->delete($media->path);
        $media->delete();
        session()->flash('message', 'Media deleted.');
    }

    public function render()
    {
        $query = Media::query()
            ->when($this->search, function ($q) {
                $q->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('file_name', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->mime_type, fn($q) => $q->where('mime_type', 'like', $this->mime_type . '%'))
            ->orderBy('created_at', 'desc');

        return view('admin.media.index', [
            'media' => $query->paginate(20),
        ])->layout('layouts.app');
    }
}
