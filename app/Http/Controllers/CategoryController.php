<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // عرض جميع الفئات
        $this->authorize('viewAny', Category::class);
        $categories = Category::paginate();
        return view('pages.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // إنشاء فئة جديدة
        $this->authorize('create', Category::class);
        $category = new Category();
        return view('pages.categories.partials.form', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryStoreRequest $request)
    {
        Category::create($request->all());
        return redirect()->route('categories.index')->with('success', __('Category created successfully'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        // تعديل فئة موجودة
        $this->authorize('update', $category);
        return view('pages.categories.partials.form', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $category->update($request->all());
        return redirect()->route('categories.index')->with('success', __('Category updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // حذف فئة موجودة
        $this->authorize('delete', $category);
        $category->delete();
        return redirect()->route('categories.index')->with('success', __('Category deleted successfully'));
    }
    public function deleted()
    {
        // عرض الفئات المحذوفة
        $this->authorize('viewAny', Category::class);
        $categories = Category::onlyTrashed()->paginate();
        return view('pages.categories.partials.deleted', compact('categories'));
    }
    /**
     * Restore the specified resource from storage.
     */
    public function restore(Category $category)
    {
        $this->authorize('restore', $category);
        $category->restore();
        return redirect()->route('categories.index')->with('success', __('Category restored successfully'));
    }

    /**
     * Force delete the specified resource from storage.
     */
    public function forceDelete(Category $category)
    {
        $this->authorize('forceDelete', $category);
        $category->forceDelete();
        return redirect()->route('categories.index')->with('success', __('Category force deleted successfully'));
    }

    /**
     * Toggle the active status of the specified resource.
     */
    public function toggleActive(Category $category)
    {
        $this->authorize('update', $category);
        $category->is_active = !$category->is_active;
        $category->save();
        return redirect()->route('categories.index')->with('success', __('Category active status toggled successfully'));
    }
}
