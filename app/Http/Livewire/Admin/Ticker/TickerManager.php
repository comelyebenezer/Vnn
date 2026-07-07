<?php

namespace App\Http\Livewire\Admin\Ticker;

use App\Models\TickerItem;
use Livewire\Component;

class TickerManager extends Component
{
    public $tickerId;
    public $text = '';
    public $icon = '🔴';
    public $is_active = true;
    public $sort_order = 0;

    public $editMode = false;

    protected function rules()
    {
        return [
            'text' => 'required|max:255',
            'icon' => 'nullable|max:10',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
        ];
    }

    public function mount($ticker = null)
    {
        if ($ticker) {
            if (is_string($ticker) || is_int($ticker)) {
                $ticker = TickerItem::findOrFail($ticker);
            }

            $this->editMode = true;
            $this->tickerId = $ticker->id;
            $this->text = $ticker->text;
            $this->icon = $ticker->icon;
            $this->is_active = $ticker->is_active;
            $this->sort_order = $ticker->sort_order;
        }
    }

    public function save()
    {
        $this->validate();

        $data = [
            'text' => $this->text,
            'icon' => $this->icon ?: '🔴',
            'is_active' => $this->is_active,
            'sort_order' => $this->sort_order,
        ];

        if ($this->editMode) {
            TickerItem::findOrFail($this->tickerId)->update($data);
            session()->flash('message', 'Ticker item updated successfully.');
        } else {
            TickerItem::create($data);
            $this->reset();
            session()->flash('message', 'Ticker item created successfully.');
        }

        return redirect()->route('admin.ticker.index');
    }

    public function render()
    {
        return view('admin.ticker.form')->layout('layouts.app');
    }
}
