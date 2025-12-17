<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Http\Requests\ItemStoreRequest;
use App\Http\Requests\ItemUpdateRequest;
use Illuminate\Http\Request;
use App\Services\ItemService;

class ItemController extends Controller
{
    protected $itemService;

    public function __construct(ItemService $itemService)
    {
        $this->itemService = $itemService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Item::class);
        $search = $request->input('search');
        $items = ($search) ? $this->itemService->getSearch($search) : $this->itemService->getAll();

        $counts = $this->itemService->getCounts();

        $itemsCount = $counts->total ?? 0;
        $activeItems = $counts->active ?? 0;
        $inactiveItems = $counts->inactive ?? 0;

        return view('pages.dashboard.items.index', compact('items', 'itemsCount', 'activeItems', 'inactiveItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Item::class);
        $item = new Item();
        return view('pages.dashboard.items.partials.form', compact('item'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemStoreRequest $request)
    {
        $this->itemService->create($request->validated());
        return redirect()->route('items.index')->with('success', __('Item created successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        $this->authorize('view', $item);
        return view('pages.dashboard.items.partials.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        $this->authorize('update', $item);
        return view('pages.dashboard.items.partials.form', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ItemUpdateRequest $request, Item $item)
    {
        $this->itemService->update($request->validated(), $item);
        return redirect()->route('items.index')->with('success', __('Item updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $this->authorize('delete', $item);
        $this->itemService->delete($item);
        return redirect()->route('items.index')->with('success', __('Item deleted successfully'));
    }

    public function toggleActive(Item $item)
    {
        $this->authorize('update', $item);
        $this->itemService->toggleActive($item);
        return back()->with('success', __('Item status updated successfully'));
    }

    public function deleted()
    {
        $this->authorize('viewAny', Item::class);
        $items = $this->itemService->getDeleted();
        return view('pages.dashboard.items.partials.deleted', compact('items'));
    }

    public function restore($id)
    {
        $item = Item::withTrashed()->findOrFail($id);
        $this->authorize('restore', $item);
        $this->itemService->restore($item);
        return back()->with('success', __('Item restored successfully'));
    }

    public function forceDelete($id)
    {
        $item = Item::withTrashed()->findOrFail($id);
        $this->authorize('forceDelete', $item);
        $this->itemService->forceDelete($item);
        return back()->with('success', __('Item deleted permanently'));
    }

    public function restoreAll()
    {
        $this->authorize('restoreAll', Item::class);
        $this->itemService->restoreAll();
        return redirect()->route('items.deleted')->with('success', __('All items restored successfully'));
    }

    public function forceDeleteAll()
    {
        $this->authorize('forceDeleteAll', Item::class);
        $this->itemService->forceDeleteAll();
        return redirect()->route('items.deleted')->with('success', __('All items force deleted successfully'));
    }
}
