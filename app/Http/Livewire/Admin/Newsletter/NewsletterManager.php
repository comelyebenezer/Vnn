<?php

namespace App\Http\Livewire\Admin\Newsletter;

use App\Models\Newsletter;
use Livewire\Component;

class NewsletterManager extends Component
{
    public $newsletterId;
    public $subject;
    public $content;
    public $status = 'draft';
    public $sent_at;
    public $total_recipients = 0;
    public $opened_count = 0;
    public $clicked_count = 0;

    public $editMode = false;

    protected function rules()
    {
        return [
            'subject' => 'required|min:2|max:255',
            'content' => 'required',
            'status' => 'required|in:draft,sent,scheduled',
        ];
    }

    public function mount($newsletter = null)
    {
        if ($newsletter) {
            $this->editMode = true;
            $this->newsletterId = $newsletter->id;
            $this->subject = $newsletter->subject;
            $this->content = $newsletter->content;
            $this->status = $newsletter->status;
            $this->sent_at = $newsletter->sent_at;
            $this->total_recipients = $newsletter->total_recipients;
            $this->opened_count = $newsletter->opened_count;
            $this->clicked_count = $newsletter->clicked_count;
        }
    }

    public function save()
    {
        $this->validate();

        $data = [
            'subject' => $this->subject,
            'content' => $this->content,
            'status' => $this->status,
        ];

        if ($this->editMode) {
            Newsletter::findOrFail($this->newsletterId)->update($data);
            session()->flash('message', 'Newsletter updated successfully.');
        } else {
            Newsletter::create($data);
            $this->reset();
            session()->flash('message', 'Newsletter created successfully.');
        }

        return redirect()->route('admin.newsletter.index');
    }

    public function render()
    {
        return view('admin.newsletter.form')->layout('layouts.app');
    }
}
