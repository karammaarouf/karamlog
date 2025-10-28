<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('roles')->paginate(10);
        return view('pages.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = new User();
        $roles = Role::where('is_active', true)->pluck('name', 'id');
        return view('pages.users.partials.form', compact('user', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // لم يتم تنفيذ الحفظ ضمن هذا الطلب. يمكنني إضافته لاحقاً.
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $user->load('roles');
        return view('pages.users.partials.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {

        $roles = Role::where('is_active', true)->pluck('name', 'id');
        return view('pages.users.partials.form', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // 
    }

    public function deleted()
    {
        $users = User::onlyTrashed()->with('roles')->paginate(10);
        return view('pages.users.partials.deleted', compact('users'));
    }

    /**
     * Restore a soft-deleted user.
     */
    public function restore(string $id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->restore();
        return redirect()->route('users.deleted')->with('success', __('User restored'));
    }

    /**
     * Permanently delete a soft-deleted user.
     */
    public function forceDelete(string $id)
    {
        $user = User::withTrashed()->findOrFail($id);
        // detach roles to avoid FK constraints, then force delete
        $user->roles()->detach();
        $user->forceDelete();
        return redirect()->route('users.deleted')->with('success', __('User permanently deleted'));
    }
}
