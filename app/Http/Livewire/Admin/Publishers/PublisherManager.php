<?php

namespace App\Http\Livewire\Admin\Publishers;

use App\Models\Publisher;
use App\Models\User;
use Livewire\Component;

class PublisherManager extends Component
{
    public $publisherId;
    public $user_id;
    public $signature;

    public $editMode = false;

    protected function rules()
    {
        return [
            'user_id' => 'required|exists:users,id|unique:publishers,user_id,' . $this->publisherId,
            'signature' => 'nullable|max:500',
        ];
    }

    public function mount($publisher = null)
    {
        if ($publisher) {
            $this->editMode = true;
            $this->publisherId = $publisher->id;
            $this->user_id = $publisher->user_id;
            $this->signature = $publisher->signature;
        }
    }

    public function save()
    {
        $this->validate();

        $data = [
            'user_id' => $this->user_id,
            'signature' => $this->signature,
        ];

        if ($this->editMode) {
            Publisher::findOrFail($this->publisherId)->update($data);
            session()->flash('message', 'Publisher updated successfully.');
        } else {
            Publisher::create($data);
            $this->reset();
            session()->flash('message', 'Publisher created successfully.');
        }

        return redirect()->route('admin.publishers.index');
    }

    public function render()
    {
        return view('admin.publishers.form', [
            'users' => User::orderBy('name')->get(),
        ])->layout('layouts.app');
    }
}
