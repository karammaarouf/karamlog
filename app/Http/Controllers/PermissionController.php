<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::orderBy('group_name')->orderBy('name')->paginate(15);
        return view('pages.permissions.index', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name',
            'group_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);
        Permission::create($data);
        return redirect()->route('permissions.index')->with('success', 'Permission created');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        return view('pages.permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name,' . $permission->id,
            'group_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);
        $permission->update($data);
        return redirect()->route('permissions.index')->with('success', 'Permission updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        $permission->roles()->detach();
        $permission->delete();
        return redirect()->route('permissions.index')->with('success', 'Permission deleted');
    }
}
