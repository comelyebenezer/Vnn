<?php

namespace App\Http\Livewire\Admin\Advertisements;

use App\Models\Advertisement;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdvertisementManager extends Component
{
    use WithFileUploads;

    public $advertisementId;
    public $title;
    public $type = 'banner';
    public $placement;
    public $image_url;
    public $media_file;
    public $existing_media;
    public $script_code;
    public $link;
    public $start_date;
    public $end_date;
    public $status = 'active';
    public $impressions = 0;
    public $clicks = 0;

    public $editMode = false;

    protected function rules()
    {
        return [
            'title' => 'required|min:2|max:255',
            'type' => 'required|in:banner,sidebar,inline,popup',
            'placement' => 'nullable|max:255',
            'image_url' => 'nullable|url|max:500',
            'media_file' => 'nullable|file|max:10240|mimes:jpg,jpeg,png,gif,webp,mp4,webm,ogg',
            'script_code' => 'nullable',
            'link' => 'nullable|url|max:500',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'required|in:active,inactive',
            'impressions' => 'integer|min:0',
            'clicks' => 'integer|min:0',
        ];
    }

    public function mount($advertisement = null)
    {
        if ($advertisement) {
            if (is_string($advertisement) || is_int($advertisement)) {
                $advertisement = Advertisement::findOrFail($advertisement);
            }

            $this->editMode = true;
            $this->advertisementId = $advertisement->id;
            $this->title = $advertisement->title;
            $this->type = $advertisement->type;
            $this->placement = $advertisement->placement;
            $this->image_url = $advertisement->image_url;
            $this->existing_media = $advertisement->media_file;
            $this->script_code = $advertisement->script_code;
            $this->link = $advertisement->link;
            $this->start_date = $advertisement->start_date ? $advertisement->start_date->format('Y-m-d') : null;
            $this->end_date = $advertisement->end_date ? $advertisement->end_date->format('Y-m-d') : null;
            $this->status = $advertisement->status;
            $this->impressions = $advertisement->impressions;
            $this->clicks = $advertisement->clicks;
        }
    }

    public function save()
    {
        $this->validate();

        $mediaPath = $this->existing_media;
        $mediaType = null;

        if ($this->media_file) {
            $mediaPath = $this->media_file->store('advertisements', 'public');
            $mime = $this->media_file->getMimeType();
            $mediaType = str_starts_with($mime, 'video/') ? 'video' : 'image';
        }

        $data = [
            'title' => $this->title,
            'type' => $this->type,
            'placement' => $this->placement ?? '',
            'image_url' => $this->image_url,
            'media_file' => $mediaPath,
            'media_type' => $mediaType,
            'script_code' => $this->script_code,
            'link' => $this->link,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'status' => $this->status,
            'impressions' => $this->impressions,
            'clicks' => $this->clicks,
        ];

        if ($this->editMode) {
            Advertisement::findOrFail($this->advertisementId)->update($data);
            session()->flash('message', 'Advertisement updated successfully.');
        } else {
            Advertisement::create($data);
            $this->reset();
            session()->flash('message', 'Advertisement created successfully.');
        }

        return redirect()->route('admin.advertisements.index');
    }

    public function render()
    {
        return view('admin.advertisements.form')->layout('layouts.app');
    }
}
