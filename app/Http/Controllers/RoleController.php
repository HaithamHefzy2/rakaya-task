<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RoleService;

class RoleController extends Controller
{
    protected RoleService $roleService;

    /**
     * Constructor to inject RoleService.
     */
    public function __construct(RoleService $roleService)
    {
        $this->middleware('auth');
        $this->roleService = $roleService;
    }

    /**
     * Display a listing of roles.
     */
    public function index()
    {
        return view('roles.index');
    }

    /**
     * Load roles for DataTables.
     */
    public function loadAjax()
    {
        return $this->roleService->loadAjax();
    }

    /**
     * Show the form for creating a new role.
     */
    public function create()
    {
        $permissions = $this->roleService->getAllPermissions(); // Fetch all permissions.
        return view('roles.form', compact('permissions'));
    }

    /**
     * Store a newly created role in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'permissions' => 'nullable|array',
        ]);

        $this->roleService->createRole($validatedData);

        return redirect()->route('roles.index')->with('success', 'Role created successfully.');
    }

    /**
     * Show the form for editing the specified role.
     */
    public function edit($id)
    {
        $role = $this->roleService->findRoleById($id);
        $permissions = $this->roleService->getAllPermissions();
        return view('roles.form', compact('role', 'permissions'));
    }

    /**
     * Update the specified role in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $id,
            'permissions' => 'nullable|array',
        ]);

        $this->roleService->updateRole($id, $validatedData);

        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }

    /**
     * Remove the specified role from storage.
     */
    public function destroy($id)
    {
        $this->roleService->deleteRole($id);
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }
}
