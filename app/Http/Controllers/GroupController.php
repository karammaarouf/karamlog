<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Http\Requests\GroupStoreRequest;
use App\Http\Requests\GroupUpdateRequest;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $groups = ($search)
            ? Group::query()
                ->where('name', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%")
                ->paginate()
            : Group::query()->paginate();

        $counts = Group::selectRaw("
                    COUNT(*) as total,
                    SUM(is_active = 1) as active,
                    SUM(is_active = 0) as inactive
                ")->first();

        $groupsCount = $counts->total ?? 0;
        $activeGroups = $counts->active ?? 0;
        $inactiveGroups = $counts->inactive ?? 0;

        return view('pages.dashboard.groups.index', compact('groups', 'groupsCount', 'activeGroups', 'inactiveGroups'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_unless(auth()->user()->can('create-groups'), 403);
        $group = new Group();
        return view('pages.dashboard.groups.partials.form', compact('group'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GroupStoreRequest $request)
    {
        abort_unless(auth()->user()->can('create-groups'), 403);
        Group::query()->create($request->validated());
        return redirect()->route('groups.index')->with('success', __('Group created successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Group $group)
    {
        // يمكن إضافة صفحة عرض التفاصيل لاحقاً عند الحاجة
        return redirect()->route('groups.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Group $group)
    {
        abort_unless(auth()->user()->can('update-groups'), 403);
        return view('pages.dashboard.groups.partials.form', compact('group'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GroupUpdateRequest $request, Group $group)
    {
        abort_unless(auth()->user()->can('update-groups'), 403);
        $group->update($request->validated());
        return redirect()->route('groups.index')->with('success', __('Group updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $group)
    {
        abort_unless(auth()->user()->can('delete-groups'), 403);
        $group->delete();
        return redirect()->route('groups.index')->with('success', __('Group deleted successfully'));
    }

    /**
     * Display a listing of the deleted resources.
     */
    public function deleted()
    {
        abort_unless(auth()->user()->can('view-groups', Group::class), 403);
        $groups = Group::onlyTrashed()->paginate();
        return view('pages.dashboard.groups.partials.deleted', compact('groups'));
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore(Group $group)
    {
        abort_unless(auth()->user()->can('restore-groups'), 403);
        $group->restore();
        return redirect()->route('groups.deleted')->with('success', __('Group restored successfully'));
    }

    /**
     * Force delete the specified resource from storage.
     */
    public function forceDelete(Group $group)
    {
        abort_unless(auth()->user()->can('force-delete-groups'), 403);
        $group->forceDelete();
        return redirect()->route('groups.deleted')->with('success', __('Group permanently deleted'));
    }

    /**
     * Toggle active status for the specified resource.
     */
    public function toggleActive(Group $group)
    {
        abort_unless(auth()->user()->can('update-groups'), 403);
        $group->is_active = !$group->is_active;
        $group->save();
        return back()->with('success', __('Group status updated'));
    }
}
