<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::with('permissions')->orderBy('name')->paginate(10);
        $permissions = Permission::where('is_active', true)->orderBy('name')->get();
        return view('pages.roles.index', compact('roles', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'group_name' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'is_active' => 'boolean',
            'permission_ids' => 'array',
            'permission_ids.*' => 'integer|exists:permissions,id',
        ]);

        $role = Role::create($data);
        $role->permissions()->sync($data['permission_ids'] ?? []);

        return redirect()->route('roles.index')->with('success', 'Role created');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::where('is_active', true)->orderBy('name')->get();
        return view('pages.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
            'group_name' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'is_active' => 'boolean',
            'permission_ids' => 'array',
            'permission_ids.*' => 'integer|exists:permissions,id',
        ]);

        $role->update($data);
        $role->permissions()->sync($data['permission_ids'] ?? []);

        return redirect()->route('roles.index')->with('success', 'Role updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->permissions()->detach();
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Role deleted');
    }
}
