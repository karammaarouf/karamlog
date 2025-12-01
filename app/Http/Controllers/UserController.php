<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // عرض جميع المستخدمين
        $this->authorize('viewAny', User::class);
        $users = User::paginate();
        $usersCount=$users->total();
        $usersCountActive=User::where('is_active', true)->count();
        $usersCountInactive=User::where('is_active', false)->count();

        $search = $request->input('search');
        if ($search) {
            $users = User::where('name', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%")
                ->paginate();
        }
        return view('pages.users.index', compact('users','usersCount','usersCountActive','usersCountInactive'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // إنشاء مستخدم جديد
        $this->authorize('create', User::class);
        $user = new User();
        $roles = Role::pluck('name', 'id');
        $userRoles = [];
        return view('pages.users.partials.form', compact('user', 'roles', 'userRoles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {   
        $user = User::create($request->validated());
        $roles=Role::whereIn('id', $request->validated('roles'))->pluck('name')->toArray();
        $user->syncRoles($roles);
        return redirect()->route('users.index')->with('success', __('User created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        // عرض تفاصيل المستخدم
        $this->authorize('view', $user);
        return view('pages.users.partials.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        // تعديل المستخدم
        $this->authorize('update', $user);
        $roles = Role::pluck('name', 'id');
        $userRoles = $user->roles->pluck('id')->toArray();
        return view('pages.users.partials.form', compact('user', 'roles', 'userRoles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $user->update($request->validated());
        $roles=Role::whereIn('id', $request->validated('roles'))->pluck('name')->toArray();
        $user->syncRoles($roles);
        return redirect()->route('users.index')->with('success', __('User updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // حذف المستخدم
        $this->authorize('delete', $user);
        $user->delete();
        
        return redirect()->route('users.index')->with('success', __('User deleted'));
    }

    /**
     * Display a listing of soft-deleted users.
     */
    public function deleted()
    {
        // عرض جميع المستخدمين المحذوفين
        $this->authorize('viewAny', User::class);
        $users = User::onlyTrashed()->paginate();
        return view('pages.users.partials.deleted', compact('users'));
    }

    /**
     * Restore a soft-deleted user.
     */
    public function restore(User $user)
    {
        // استعادة المستخدم المحذوف
        $this->authorize('restore', $user);
        $user->restore();
        return redirect()->route('users.deleted')->with('success', __('User restored'));
    }

    /**
     * Permanently delete a soft-deleted user.
     */
    public function forceDelete(User $user)
    {
        // حذف المستخدم بشكل نهائي
        $this->authorize('forceDelete', $user);
        $user->forceDelete();
        return redirect()->route('users.deleted')->with('success', __('User force deleted'));
    }

    /**
     * Toggle the active status of a user.
     */
    public function toggleActive(User $user)
    {
        // تبديل حالة النشاط للمستخدم
        $this->authorize('update', $user);
        $user->is_active = !$user->is_active;
        $user->save();
        return redirect()->route('users.index')->with('success', __('User active status updated'));
    }
}
