<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use App\Models\Group;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = Item::query()->where('is_active', true);

        // if ($request->has('category')) {
        //     $query->whereHas('categories', function ($q) use ($request) {
        //         $q->where('id', $request->category);
        //     });
        // }

        // if ($request->has('group')) {
        //     $query->whereHas('group', function ($q) use ($request) {
        //         $q->where('id', $request->group);
        //     });
        // }

        if ($request->has('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        $items = $query->latest()->paginate();
        $categories = Category::where('is_active', true)->get();
        $groups = Group::where('is_active', true)->get();

        return view('pages.customer.index', compact('items', 'categories', 'groups'));
    }
}
