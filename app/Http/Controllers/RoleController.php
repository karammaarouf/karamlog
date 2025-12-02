<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Requests\RoleStoreRequest;
use App\Http\Requests\RoleUpdateRequest;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{

    public function index(Request $request)
    {
        $this->authorize('view-roles', Role::class);
        $search = $request->input('search');
        if ($search) {
            $roles = Role::where('name', 'like', "%$search%")
                ->orWhere('description', 'like', "%$search%")
                ->with('permissions')
                ->paginate();
        } else {
            $roles = Role::paginate();
        }
        return view('pages.roles.index', compact('roles'));
    }

    public function create()
    {
        $this->authorize('create-roles', Role::class);
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
        $this->authorize('show-roles', $role);
        return view('pages.roles.partials.show', compact('role'));
    }

    public function edit(Role $role)
    {
        $this->authorize('update-roles', $role);
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
