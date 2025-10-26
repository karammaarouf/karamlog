<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('roles')->get();
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
        return view('pages.users.partials.form', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // لم يتم تنفيذ التحديث ضمن هذا الطلب. يمكنني إضافته لاحقاً.
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // لم يتم تنفيذ الحذف ضمن هذا الطلب. يمكنني إضافته لاحقاً.
    }

    public function deleted()
    {
        $users = User::onlyTrashed()->get();
        return view('pages.users.partials.deleted', compact('users'));
    }
}
