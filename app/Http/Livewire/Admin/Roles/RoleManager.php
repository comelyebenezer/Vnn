<?php

namespace App\Http\Livewire\Admin\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleManager extends Component
{
    public $roleId;
    public $name;
    public $guard_name = 'web';
    public $selectedPermissions = [];

    public $editMode = false;

    protected function rules()
    {
        return [
            'name' => 'required|min:2|max:255|unique:roles,name,' . $this->roleId,
            'guard_name' => 'required|in:web,api',
            'selectedPermissions' => 'array',
        ];
    }

    public function mount($role = null)
    {
        if ($role) {
            if (is_string($role) || is_int($role)) {
                $role = \Spatie\Permission\Models\Role::findOrFail($role);
            }

            $this->editMode = true;
            $this->roleId = $role->id;
            $this->name = $role->name;
            $this->guard_name = $role->guard_name;
            $this->selectedPermissions = $role->permissions->pluck('id')->map(fn($id) => (string) $id)->toArray();
        }
    }

    public function save()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'guard_name' => $this->guard_name,
        ];

        if ($this->editMode) {
            $role = Role::findOrFail($this->roleId);
            $role->update($data);
            $role->syncPermissions($this->selectedPermissions);
            session()->flash('message', 'Role updated successfully.');
        } else {
            $role = Role::create($data);
            $role->syncPermissions($this->selectedPermissions);
            session()->flash('message', 'Role created successfully.');
        }

        return redirect()->route('admin.roles.index');
    }

    public function render()
    {
        $permissions = Permission::orderBy('name')->get();
        $grouped = $permissions->groupBy(function ($perm) {
            $parts = explode('.', $perm->name);
            return count($parts) > 1 ? $parts[0] . '.*' : 'general';
        });

        return view('admin.roles.form', [
            'groupedPermissions' => $grouped,
        ])->layout('layouts.app');
    }
}
