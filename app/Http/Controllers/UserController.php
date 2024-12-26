<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected UserService $userService;

    /**
     * Inject UserService into the controller.
     */
    public function __construct(UserService $userService)
    {
        $this->middleware('auth');
        $this->userService = $userService;
    }

    /**
     * Display a listing of users.
     */
    public function index()
    {
        return view('users.index');
    }

    /**
     * Load users for DataTables.
     */
    public function loadAjax()
    {
        return $this->userService->loadAjax();
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        $roles = $this->userService->getAllRoles();
        return view('users.form', compact('roles'));
    }

    /**
     * Store a newly created user.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'roles' => 'required|exists:roles,id',
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);


        $this->userService->create($validatedData);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    /**
     * Show the form for editing a user.
     */
    public function edit($id)
    {
        $user = $this->userService->find($id);
        $roles = $this->userService->getAllRoles();
        return view('users.form', compact('user', 'roles'));
    }

    /**
     * Update the specified user.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->all();
        $this->userService->update($id, $validatedData);
        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove a user.
     */
    public function destroy($id)
    {
        $this->userService->delete($id);
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
    /**
     * logout .
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'You have been logged out successfully.');
    }
}
