<?php

namespace App\Services\Interfaces;

use App\Models\Category;

interface CategoryServiceInterface
{
    // return all data
    public function getAll();
    // return search data
    public function getSearch(string $search);
    // return count data
    public function getCounts();
    // create data
    public function create(array $data);
    // update data
    public function update(Category $category, array $data);
    // toggle active data
    public function toggleActive(Category $category);
    // delete data
    public function delete(Category $category);
    // return deleted data
    public function getTrashed();
    // restore data
    public function restore(Category $category);
    // force delete data
    public function forceDelete(Category $category);

}
