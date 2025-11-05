<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
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
        $users = User::paginate();
        return view('pages.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = new User();
        return view('pages.users.partials.form', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {   
        $user = User::create($request->validated());
        return redirect()->route('users.index')->with('success', __('User created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('pages.users.partials.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {

        return view('pages.users.partials.form', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $user->update($request->only(['name', 'email', 'is_active']));
        return redirect()->route('users.index')->with('success', __('User updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // حذف المستخدم
        $user->delete();
        
        return redirect()->route('users.index')->with('success', __('User deleted'));
    }

    public function deleted()
    {
        $users = User::onlyTrashed()->paginate();
        return view('pages.users.partials.deleted', compact('users'));
    }

    /**
     * Restore a soft-deleted user.
     */
    public function restore(User $user)
    {
        $user->restore();
        return redirect()->route('users.deleted')->with('success', __('User restored'));
    }

    /**
     * Permanently delete a soft-deleted user.
     */
    public function forceDelete(User $user)
    {
        $user->forceDelete();
        return redirect()->route('users.deleted')->with('success', __('User permanently deleted'));
    }

    /**
     * Toggle the active status of a user.
     */
    public function toggleActive(User $user)
    {
        $user->is_active = !$user->is_active;
        $user->save();
        return redirect()->route('users.index')->with('success', __('User active status updated'));
    }
}
