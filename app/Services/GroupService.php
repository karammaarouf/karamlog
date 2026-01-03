<?php
namespace App\Services;
use App\Models\Group;
use App\Services\Interfaces\GroupServiceInterface;

class GroupService implements GroupServiceInterface
{

    public function getAll()
    {
        return Group::query()->withCount('items')->paginate();
    }

    public function getSearch(string $query)
    {
        return Group::query()
                ->where('name', 'like', "%{$query}%")
                ->orWhere('description', 'like', "%{$query}%")
                ->withCount('items')
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
        $name=$data['name_en']??$data['name_ar'];
        $description=$data['description_en']??$data['description_ar'];

        $group= Group::create([
            'name'=>$name,
            'description'=>$description,
            'is_active'=>$data['is_active']??true,
        ]);
        $locales = config('app.available_locales', ['en', 'ar']);
        foreach ($locales as $locale) {
            $translations = [
                'name' => $data['name_' . $locale],
                'description' => $data['description_' . $locale],
            ];
            if ($translations['name'] || $translations['description']) {
                $group->saveTranslation($translations, $locale);
            }
        }
        return $group;
    }

    public function update(array $data, Group $group)
    {
        $name=$data['name_en']??$data['name_ar'];
        $description=$data['description_en']??$data['description_ar'];
        $group->update([
            'name'=>$name,
            'description'=>$description,
            'is_active'=>$data['is_active']??true,
        ]);
        $locales = config('app.available_locales', ['en', 'ar']);
        foreach ($locales as $locale) {
            $translations = [
                'name' => $data['name_' . $locale],
                'description' => $data['description_' . $locale],
            ];
            if ($translations['name'] || $translations['description']) {
                $group->saveTranslation($translations, $locale);
            }
        }
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