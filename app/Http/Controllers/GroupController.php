<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Http\Requests\GroupStoreRequest;
use App\Http\Requests\GroupUpdateRequest;
use Illuminate\Http\Request;
use App\Services\GroupService;

class GroupController extends Controller
{
    protected $groupService;

    public function __construct(GroupService $groupService)
    {
        $this->groupService = $groupService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Group::class);
        $search = $request->input('search');
        $groups = ($search) ? $this->groupService->getSearch($search) : $this->groupService->getAll();

        $counts = $this->groupService->getCounts();

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
        $this->authorize('create', Group::class);
        $group = new Group();
        return view('pages.dashboard.groups.partials.form', compact('group'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GroupStoreRequest $request)
    {
        $this->groupService->create($request->validated());
        return redirect()->route('groups.index')->with('success', __('Group created successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Group $group)
    {
        $this->authorize('view', $group);
        return view('pages.dashboard.groups.partials.show', compact('group'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Group $group)
    {
        $this->authorize('update', $group);
        return view('pages.dashboard.groups.partials.form', compact('group'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GroupUpdateRequest $request, Group $group)
    {
        $this->groupService->update($request->validated(), $group);
        return redirect()->route('groups.index')->with('success', __('Group updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $group)
    {
        $this->authorize('delete', $group);
        $this->groupService->delete($group);
        return redirect()->route('groups.index')->with('success', __('Group deleted successfully'));
    }

    /**
     * Display a listing of the deleted resources.
     */
    public function deleted()
    {
        $this->authorize('viewAny', Group::class);
        $groups = $this->groupService->getDeleted();
        return view('pages.dashboard.groups.partials.deleted', compact('groups'));
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore(Group $group)
    {
        $this->authorize('restore', $group);
        $this->groupService->restore($group);
        return redirect()->route('groups.deleted')->with('success', __('Group restored successfully'));
    }

    /**
     * Force delete the specified resource from storage.
     */
    public function forceDelete(Group $group)
    {
        $this->authorize('forceDelete', $group);
        $this->groupService->forceDelete($group);
        return redirect()->route('groups.deleted')->with('success', __('Group permanently deleted'));
    }

    /**
     * Toggle active status for the specified resource.
     */
    public function toggleActive(Group $group)
    {
        $this->authorize('update', $group);
        $this->groupService->toggleActive($group);
        return back()->with('success', __('Group status updated'));
    }
}
