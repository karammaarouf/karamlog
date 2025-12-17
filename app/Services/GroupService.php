<?php
namespace App\Services;
use App\Models\Group;
use App\Services\Interfaces\GroupServiceInterface;

class GroupService implements GroupServiceInterface
{

    public function getAll()
    {
        return Group::query()->paginate();
    }

    public function getSearch(string $query)
    {
        return Group::query()
                ->where('name', 'like', "%{$query}%")
                ->orWhere('description', 'like', "%{$query}%")
                ->paginate();
    }

    public function getCounts()
    {
        return Group::selectRaw("
                    COUNT(*) as total,
                    SUM(is_active = 1) as active,
                    SUM(is_active = 0) as inactive
                ")->first();;
    }

    public function create(array $data)
    {
        return Group::create($data);
    }

    public function update(array $data, Group $group)
    {
        $group->update($data);
        return $group;
    }

    public function toggleActive(Group $group)
    {
        $group->is_active = !$group->is_active;
        $group->save();
        return $group;
    }

    public function delete(Group $group)
    {
        $group->delete();
        return $group;
    }

    public function getDeleted()
    {
        return Group::onlyTrashed()->paginate();
    }

    public function restore(Group $group)
    {
        $group->restore();
        return $group;
    }

    public function forceDelete(Group $group)
    {
        $group->forceDelete();
        return $group;
    }

    public function restoreAll()
    {
        Group::onlyTrashed()->restore();
    }

    public function forceDeleteAll()
    {
        Group::onlyTrashed()->forceDelete();
    }
}