<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Role;
use App\Models\Permission;

class RolesTable extends Component
{
    public $roles, $permissions, $role, $roleId, $roleName, $rolePermissions = [];
    public $isEditing = false, $isModalOpen = false;

    protected $rules = [
        'roleName' => 'required|string|max:255',
        'rolePermissions' => 'array'
    ];

    public function mount()
    {
        $this->loadRolesAndPermissions();
    }

    public function loadRolesAndPermissions()
    {
        $this->roles = Role::with('permissions')->get();
        $this->permissions = Permission::all();
    }

    public function openModal()
    {
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->reset(['roleName', 'rolePermissions', 'isEditing', 'isModalOpen', 'roleId']);
    }

    public function edit($id)
    {
        $this->isEditing = true;
        $role = Role::findOrFail($id);
        $this->roleId = $role->id;
        $this->roleName = $role->name;
        $this->rolePermissions = $role->permissions->pluck('id')->toArray();
        $this->openModal();
    }

    public function save()
    {
        $this->validate();

        if ($this->isEditing) {
            $role = Role::findOrFail($this->roleId);
            $role->update(['name' => $this->roleName]);
        } else {
            $role = Role::create(['name' => $this->roleName]);
        }

        $role->permissions()->sync($this->rolePermissions);

        $this->loadRolesAndPermissions();
        $this->closeModal();
    }

    public function delete($id)
    {
        Role::findOrFail($id)->delete();
        $this->loadRolesAndPermissions();
    }

    public function render()
    {
        return view('livewire.roles-table');
    }
}
