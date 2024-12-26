<?php

namespace App\Repositories;

use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class RoleRepository
{
    /**
     * Load roles for DataTables.
     */
    public function loadAjax()
    {
        $roles = Role::with('permissions');

        return DataTables::of($roles)
            ->addColumn('permissions', function ($role) {
                return implode(', ', $role->permissions->pluck('name')->toArray());
            })
            ->addColumn('action', function ($role) {
                return '
                    <a href="' . route('roles.edit', $role->id) . '" class="btn btn-primary btn-sm">Edit</a>
                    <form action="' . route('roles.destroy', $role->id) . '" method="POST" style="display:inline;">
                        ' . csrf_field() . method_field('DELETE') . '
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </form>
                '; // Define actions for each role.
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Create a new role.
     */
    public function create(array $data)
    {
        $role = Role::create(['name' => $data['name']]);

        if (!empty($data['permissions'])) {
            $role->syncPermissions($data['permissions']);
        }

        return $role;
    }

    /**
     * Find a role by ID.
     */
    public function find($id)
    {
        return Role::findOrFail($id);
    }

    /**
     * Update a role.
     */
    public function update($id, array $data)
    {
        $role = $this->find($id);
        $role->update(['name' => $data['name']]);

        if (!empty($data['permissions'])) {
            $role->syncPermissions($data['permissions']);
        } else {
            $role->revokePermissionTo($role->permissions);
        }

        return $role;
    }

    /**
     * Delete a role.
     */
    public function delete($id)
    {
        $role = $this->find($id);
        return $role->delete();
    }
}
