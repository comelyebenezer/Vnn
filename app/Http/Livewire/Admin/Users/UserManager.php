<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;

class UserManager extends Component
{
    use WithFileUploads;

    public $userId;
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $designation;
    public $phone;
    public $bio;
    public $avatar;
    public $existingAvatar;
    public $status = 'active';
    public $selectedRoles = [];

    public $editMode = false;

    protected function rules()
    {
        $rules = [
            'name' => 'required|min:2|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $this->userId,
            'designation' => 'nullable|max:255',
            'phone' => 'nullable|max:50',
            'bio' => 'nullable|max:1000',
            'avatar' => 'nullable|image|max:2048',
            'status' => 'required|in:active,inactive',
            'selectedRoles' => 'array',
        ];

        if (!$this->editMode) {
            $rules['password'] = 'required|min:8|confirmed';
            $rules['password_confirmation'] = 'required';
        } else {
            $rules['password'] = 'nullable|min:8|confirmed';
        }

        return $rules;
    }

    public function mount($user = null)
    {
        if ($user) {
            if (is_string($user) || is_int($user)) {
                $user = \App\Models\User::findOrFail($user);
            }

            $this->editMode = true;
            $this->userId = $user->id;
            $this->name = $user->name;
            $this->email = $user->email;
            $this->designation = $user->designation;
            $this->phone = $user->phone;
            $this->bio = $user->bio;
            $this->existingAvatar = $user->avatar;
            $this->status = $user->status;
            $this->selectedRoles = $user->roles->pluck('id')->map(fn($id) => (string) $id)->toArray();
        }
    }

    public function save()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'designation' => $this->designation,
            'phone' => $this->phone,
            'bio' => $this->bio,
            'status' => $this->status,
        ];

        if ($this->avatar) {
            $data['avatar'] = $this->avatar->store('avatars', 'public');
        }

        if ($this->password) {
            $data['password'] = Hash::make($this->password);
        }

        if ($this->editMode) {
            $user = User::findOrFail($this->userId);
            $user->update($data);
            $roleNames = Role::whereIn('id', $this->selectedRoles)->pluck('name')->toArray();
            $user->syncRoles($roleNames);
            session()->flash('message', 'User updated successfully.');
        } else {
            if (!isset($data['password'])) {
                $data['password'] = Hash::make('password');
            }
            $user = User::create($data);
            $roleNames = Role::whereIn('id', $this->selectedRoles)->pluck('name')->toArray();
            $user->syncRoles($roleNames);
            session()->flash('message', 'User created successfully.');
        }

        return redirect()->route('admin.users.index');
    }

    public function render()
    {
        return view('admin.users.form', [
            'roles' => Role::orderBy('name')->get(),
        ])->layout('layouts.app');
    }
}
