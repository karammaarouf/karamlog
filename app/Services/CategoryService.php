<?php
namespace App\Services;

use App\Models\Category;
use App\Services\Interfaces\CategoryServiceInterface;

class CategoryService implements CategoryServiceInterface
{
    // return all data
    public function getAll()
    {
       $categories= Category::paginate();
        return $categories;
    }
}