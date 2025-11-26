<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Requests\RoleStoreRequest;
use App\Http\Requests\RoleUpdateRequest;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->paginate();
        return view('pages.roles.index', compact('roles'));
    }

    public function create()
    {
        $role = new Role();
        $permissionGroups = Permission::query()->orderBy('group_name')->get()->groupBy('group_name');
        $selectedPermissions = [];
        return view('pages.roles.partials.form', compact('role', 'permissionGroups', 'selectedPermissions'));
    }

    public function store(RoleStoreRequest $request)
    {
        $role = Role::create([
            'name' => $request['name'],
            'description' => $request['description'],
            'guard_name' => config('auth.defaults.guard', 'web'),
        ]);
        $role->syncPermissions($request['permissions'] ?? []);
        return redirect()->route('roles.index')->with('success', __('Role created'));
    }

    public function show(Role $role)
    {
        return view('pages.roles.partials.show', compact('role'));
    }

    public function edit(Role $role)
    {
        $permissionGroups = Permission::query()->orderBy('group_name')->get()->groupBy('group_name');
        $selectedPermissions = $role->permissions()->pluck('name')->toArray();
        return view('pages.roles.partials.form', compact('role', 'permissionGroups', 'selectedPermissions'));
    }

    public function update(RoleUpdateRequest $request, Role $role)
    {
        $role->update([
            'name' => $request['name'],
            'description' => $request['description'],
        ]);
        $role->syncPermissions($request['permissions'] ?? []);
        return redirect()->route('roles.index')->with('success', __('Role updated'));
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('success', __('Role deleted'));
    }
}
