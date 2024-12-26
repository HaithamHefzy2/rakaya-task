<?php

namespace App\Services;

use App\Repositories\RoleRepository;
use Spatie\Permission\Models\Permission;

class RoleService
{
    protected RoleRepository $roleRepository;

    /**
     * Constructor to inject RoleRepository.
     */
    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    /**
     * Load roles for DataTables.
     */
    public function loadAjax()
    {
        return $this->roleRepository->loadAjax();
    }

    /**
     * Get all permissions.
     */
    public function getAllPermissions()
    {
        return Permission::all();
    }

    /**
     * Create a new role.
     */
    public function createRole(array $data)
    {
        return $this->roleRepository->create($data);
    }

    /**
     * Find a role by ID.
     */
    public function findRoleById($id)
    {
        return $this->roleRepository->find($id);
    }

    /**
     * Update an existing role.
     */
    public function updateRole($id, array $data)
    {
        return $this->roleRepository->update($id, $data);
    }

    /**
     * Delete a role by ID.
     */
    public function deleteRole($id)
    {
        return $this->roleRepository->delete($id);
    }
}
