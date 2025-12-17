<?php
namespace App\Services;
use App\Models\Item;
use App\Services\Interfaces\ItemServiceInterface;

class ItemService implements ItemServiceInterface
{

    public function getAll()
    {
        return Item::query()->paginate();
    }

    public function getSearch(string $query)
    {
        return Item::query()
                ->where('name', 'like', "%{$query}%")
                ->orWhere('description', 'like', "%{$query}%")
                ->orWhere('code', 'like', "%{$query}%")
                ->paginate();
    }

    public function getCounts()
    {
        return Item::selectRaw("
                    COUNT(*) as total,
                    SUM(is_active = 1) as active,
                    SUM(is_active = 0) as inactive
                ")->first();
    }

    public function create(array $data)
    {
        return Item::create($data);
    }

    public function update(array $data, Item $item)
    {
        $item->update($data);
        return $item;
    }

    public function toggleActive(Item $item)
    {
        $item->is_active = !$item->is_active;
        $item->save();
        return $item;
    }

    public function delete(Item $item)
    {
        $item->delete();
        return $item;
    }

    public function getDeleted()
    {
        return Item::onlyTrashed()->paginate();
    }

    public function restore(Item $item)
    {
        $item->restore();
        return $item;
    }

    public function forceDelete(Item $item)
    {
        $item->forceDelete();
        return $item;
    }

    public function restoreAll()
    {
        Item::onlyTrashed()->restore();
    }

    public function forceDeleteAll()
    {
        Item::onlyTrashed()->forceDelete();
    }
}
