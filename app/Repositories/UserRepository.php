<?php

namespace App\Repositories;

use App\Models\User;
use Yajra\DataTables\Facades\DataTables;

class UserRepository
{
    /**
     * Load users for DataTables.
     */
    public function loadAjax()
    {
        $users = User::with('roles')->get();

        return DataTables::of($users)
            ->addColumn('roles', fn($user) => implode(', ', $user->roles->pluck('name')->toArray()))
            ->addColumn('action', fn($user) => '
            <a href="' . route('users.edit', $user->id) . '" class="btn btn-primary btn-sm">Edit</a>
            <form action="' . route('users.destroy', $user->id) . '" method="POST" style="display:inline;">
                ' . csrf_field() . method_field('DELETE') . '
                <button class="btn btn-danger btn-sm">Delete</button>
            </form>
        ')
            ->addIndexColumn()
            ->make(true);
    }

    /**
     * Create a new user.
     */
    public function create(array $data)
    {
        return User::create($data);
    }

    /**
     * Find a user by ID.
     */
    public function find($id)
    {
        return User::findOrFail($id);
    }

    /**
     * Update a user.
     */
    public function update($id, array $data)
    {
        $user = $this->find($id);
        $user->update($data);
        return $user;
    }

    /**
     * Delete a user.
     */
    public function delete($id)
    {
        $user = $this->find($id);
        return $user->delete();
    }
}
