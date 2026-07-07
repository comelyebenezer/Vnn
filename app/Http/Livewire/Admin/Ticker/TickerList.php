<?php

namespace App\Http\Livewire\Admin\Ticker;

use App\Models\TickerItem;
use Livewire\Component;
use Livewire\WithPagination;

class TickerList extends Component
{
    use WithPagination;

    public function deleteTicker($id)
    {
        TickerItem::findOrFail($id)->delete();
        session()->flash('message', 'Ticker item deleted.');
    }

    public function toggleActive($id)
    {
        $item = TickerItem::findOrFail($id);
        $item->update(['is_active' => !$item->is_active]);
    }

    public function render()
    {
        return view('admin.ticker.index', [
            'tickers' => TickerItem::orderBy('sort_order')->orderBy('created_at', 'desc')->paginate(15),
        ])->layout('layouts.app');
    }
}
