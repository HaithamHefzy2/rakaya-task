<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Spatie\Permission\Models\Role;

class UserService
{
    protected UserRepository $userRepository;

    /**
     * Constructor to inject UserRepository.
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Load users for DataTables.
     */
    public function loadAjax()
    {
        return $this->userRepository->loadAjax();
    }

    /**
     * Get all roles.
     */
    public function getAllRoles()
    {
        return Role::all();
    }

    /**
     * Create a new user.
     */
    public function create(array $data)
    {
        // Extract roles from the data and remove it
        $roles = $data['roles'] ?? [];
        unset($data['roles']);

        // Create the user using the repository
        $user = $this->userRepository->create($data);

        // Sync roles to the user
        if (!empty($roles)) {
            // Ensure $roles is an array
            $roles = is_array($roles) ? $roles : [$roles];
            $roleNames = Role::whereIn('id', $roles)->pluck('name')->toArray();
            $user->syncRoles($roleNames);
        }

        return $user;
    }

    /**
     * Find a user by ID.
     */
    public function find($id)
    {
        return $this->userRepository->find($id);
    }

    /**
     * Update a user.
     */
    public function update($id, array $data)
    {
        // Extract roles from the data and remove it
        $roles = $data['roles'] ?? [];
        unset($data['roles']);

        // Update the user using the repository
        $user = $this->userRepository->update($id, $data);

        // Sync roles to the user
        if (!empty($roles)) {
            // Ensure $roles is an array
            $roles = is_array($roles) ? $roles : [$roles];
            $roleNames = Role::whereIn('id', $roles)->pluck('name')->toArray();
            $user->syncRoles($roleNames);
        }

        return $user;
    }
    /**
     * Delete a user.
     */
    public function delete($id)
    {
        return $this->userRepository->delete($id);
    }
}
