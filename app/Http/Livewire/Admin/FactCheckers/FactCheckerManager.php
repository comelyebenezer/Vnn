<?php

namespace App\Http\Livewire\Admin\FactCheckers;

use App\Models\FactChecker;
use App\Models\User;
use Livewire\Component;

class FactCheckerManager extends Component
{
    public $factCheckerId;
    public $user_id;
    public $specialization;
    public $certification;

    public $editMode = false;

    protected function rules()
    {
        return [
            'user_id' => 'required|exists:users,id|unique:fact_checkers,user_id,' . $this->factCheckerId,
            'specialization' => 'nullable|max:255',
            'certification' => 'nullable|max:500',
        ];
    }

    public function mount($factChecker = null)
    {
        if ($factChecker) {
            if (is_string($factChecker) || is_int($factChecker)) {
                $factChecker = \App\Models\FactChecker::findOrFail($factChecker);
            }

            $this->editMode = true;
            $this->factCheckerId = $factChecker->id;
            $this->user_id = $factChecker->user_id;
            $this->specialization = $factChecker->specialization;
            $this->certification = $factChecker->certification;
        }
    }

    public function save()
    {
        $this->validate();

        $data = [
            'user_id' => $this->user_id,
            'specialization' => $this->specialization,
            'certification' => $this->certification,
        ];

        if ($this->editMode) {
            FactChecker::findOrFail($this->factCheckerId)->update($data);
            session()->flash('message', 'Fact checker updated successfully.');
        } else {
            FactChecker::create($data);
            $this->reset();
            session()->flash('message', 'Fact checker created successfully.');
        }

        return redirect()->route('admin.fact-checkers.index');
    }

    public function render()
    {
        return view('admin.fact-checkers.form', [
            'users' => User::orderBy('name')->get(),
        ])->layout('layouts.app');
    }
}
