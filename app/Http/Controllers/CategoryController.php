<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    protected $categoryService;
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // عرض جميع الفئات
        $this->authorize('viewAny', Category::class);

        $search = $request->input('search');
        $categories = $search 
        ? $this->categoryService->getSearch($search) 
        : $this->categoryService->getAll();

        $counts = $this->categoryService->getCounts();
        $categoriesCount = $counts->total;
        $inactiveCategories = $counts->inactive;
        $activeCategories = $counts->active;



        return view('pages.categories.index', compact('categories', 'inactiveCategories', 'activeCategories', 'categoriesCount'));
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
        $this->categoryService->create($request->all());
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
        $this->categoryService->update($category, $request->all());
        return redirect()->route('categories.index')->with('success', __('Category updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // حذف فئة موجودة
        $this->authorize('delete', $category);
        $this->categoryService->delete($category);
        return redirect()->route('categories.index')->with('success', __('Category deleted successfully'));
    }
    public function deleted()
    {
        // عرض الفئات المحذوفة
        $this->authorize('viewAny', Category::class);
        $categories = $this->categoryService->getDeleted();
        return view('pages.categories.partials.deleted', compact('categories'));
    }
    /**
     * Restore the specified resource from storage.
     */
    public function restore(Category $category)
    {
        $this->authorize('restore', $category);
        $this->categoryService->restore($category);
        return redirect()->route('categories.index')->with('success', __('Category restored successfully'));
    }

    /**
     * Force delete the specified resource from storage.
     */
    public function forceDelete(Category $category)
    {
        $this->authorize('forceDelete', $category);
        $this->categoryService->forceDelete($category);
        return redirect()->route('categories.index')->with('success', __('Category force deleted successfully'));
    }

    /**
     * Toggle the active status of the specified resource.
     */
    public function toggleActive(Category $category)
    {
        $this->authorize('update', $category);
        $this->categoryService->toggleActive($category);
        return redirect()->route('categories.index')->with('success', __('Category active status toggled successfully'));
    }
}
