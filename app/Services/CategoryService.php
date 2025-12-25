<?php

namespace App\Services;

use App\Models\Category;
use App\Services\Interfaces\CategoryServiceInterface;

class CategoryService implements CategoryServiceInterface
{
    // return all data
    public function getAll()
    {
        $categories = Category::paginate();
        return $categories;
    }
    // return search data
    public function getSearch(string $search)
    {
        $categories = Category::where('name', 'like', "%$search%")
            ->paginate();
        return $categories;
    }
    // return count data
    public function getCounts()
    {
        $counts = Category::selectRaw("
                    COUNT(*) as total,
                    SUM(is_active = 1) as active,
                    SUM(is_active = 0) as inactive
                    ")->first();
        return $counts;
    }
    // create data
    public function create(array $data)
    {
        $name = $data['name_en']??$data['name_ar'];
        $description = $data['description_en']??$data['description_ar'];
        // إنشاء الفئة
        $category = Category::create([
            'name' => $name,
            'description' => $description,
            'is_active' => $data['is_active'],
        ]);
        $locales = config('app.available_locales', ['en', 'ar']);
        foreach ($locales as $locale) {
            $translations = [
                'name' => $data['name_' . $locale],
                'description' => $data['description_' . $locale],
            ];
            if ($translations['name'] || $translations['description']) {
                $category->saveTranslation($translations, $locale);
            }
        }
        // حفظ الترجمات

        return $category;
    }
    // update data
    public function update(Category $category, array $data)
    {
        $name = $data['name_en']??$data['name_ar'];
        $description = $data['description_en']??$data['description_ar'];
        $category->update(
            [
                'name' => $name,
                'description' => $description,
                'is_active' => $data['is_active'],
            ]
        );

        $locales = config('app.available_locales', ['en', 'ar']);
        foreach ($locales as $locale) {
            $translations = [
                'name' => $data['name_' . $locale],
                'description' => $data['description_' . $locale],
            ];
            if ($translations['name'] || $translations['description']) {
                $category->saveTranslation($translations, $locale);
            }
        }

        return $category;
    }
    // toggle active data
    public function toggleActive(Category $category)
    {
        $category->is_active = !$category->is_active;
        $category->save();
        return $category;
    }
    // delete data
    public function delete(Category $category)
    {
        $category->delete();
        return $category;
    }
    // return deleted data
    public function getDeleted()
    {
        $categories = Category::onlyTrashed()->paginate();
        return $categories;
    }
    // restore data
    public function restore(Category $category)
    {
        $category->restore();
        return $category;
    }
    // force delete data
    public function forceDelete(Category $category)
    {
        $category->forceDelete();
        return $category;
    }

    public function restoreAll()
    {
        Category::onlyTrashed()->restore();
    }

    public function forceDeleteAll()
    {
        Category::onlyTrashed()->forceDelete();
    }
}
