<?php

namespace App\Http\Livewire\Admin\Authors;

use App\Models\Author;
use App\Models\User;
use Livewire\Component;

class AuthorManager extends Component
{
    public $authorId;
    public $user_id;
    public $bio;
    public $expertise;
    public $facebook_url;
    public $twitter_url;
    public $instagram_url;
    public $linkedin_url;
    public $website_url;
    public $is_featured = false;

    public $editMode = false;

    protected function rules()
    {
        return [
            'user_id' => 'required|exists:users,id|unique:authors,user_id,' . $this->authorId,
            'bio' => 'nullable|max:1000',
            'expertise' => 'nullable|max:255',
            'facebook_url' => 'nullable|url|max:500',
            'twitter_url' => 'nullable|url|max:500',
            'instagram_url' => 'nullable|url|max:500',
            'linkedin_url' => 'nullable|url|max:500',
            'website_url' => 'nullable|url|max:500',
            'is_featured' => 'boolean',
        ];
    }

    public function mount($author = null)
    {
        if ($author) {
            if (is_string($author) || is_int($author)) {
                $author = \App\Models\Author::findOrFail($author);
            }

            $this->editMode = true;
            $this->authorId = $author->id;
            $this->user_id = $author->user_id;
            $this->bio = $author->bio;
            $this->expertise = $author->expertise;
            $this->facebook_url = $author->facebook_url;
            $this->twitter_url = $author->twitter_url;
            $this->instagram_url = $author->instagram_url;
            $this->linkedin_url = $author->linkedin_url;
            $this->website_url = $author->website_url;
            $this->is_featured = $author->is_featured;
        }
    }

    public function save()
    {
        $this->validate();

        $data = [
            'user_id' => $this->user_id,
            'bio' => $this->bio,
            'expertise' => $this->expertise,
            'facebook_url' => $this->facebook_url,
            'twitter_url' => $this->twitter_url,
            'instagram_url' => $this->instagram_url,
            'linkedin_url' => $this->linkedin_url,
            'website_url' => $this->website_url,
            'is_featured' => $this->is_featured,
        ];

        if ($this->editMode) {
            Author::findOrFail($this->authorId)->update($data);
            session()->flash('message', 'Author updated successfully.');
        } else {
            Author::create($data);
            $this->reset();
            session()->flash('message', 'Author created successfully.');
        }

        return redirect()->route('admin.authors.index');
    }

    public function render()
    {
        return view('admin.authors.form', [
            'users' => User::orderBy('name')->get(),
        ])->layout('layouts.app');
    }
}
