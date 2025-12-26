<?php
namespace App\Services;

use Spatie\Permission\Models\Role;
use App\Services\Interfaces\RoleServiceInterface;

class RoleService implements RoleServiceInterface
{
    // return all data
    public function getAll()
    {
       $roles= Role::with('permissions')->paginate();
        return $roles;
    }
    // return search data
    public function getSearch(string $search)
    {
        $roles = Role::where('name', 'like', "%$search%")
            ->orWhere('description', 'like', "%$search%")
            ->with('permissions')
            ->paginate();
        return $roles;
    }
    // create data
    public function create(array $data)
    {
        $name=$data['name_en']??$data['name_ar'];
        $description=$data['description_en']??$data['description_ar'];
        $role = Role::create([
            'name' => $name,
            'description' => $description,
            'guard_name' => config('auth.defaults.guard', 'web'),
        ]);
        $role->syncPermissions($data['permissions'] ?? []);
                $locales = config('app.available_locales', ['en', 'ar']);
        foreach ($locales as $locale) {
            $translations = [
                'name' => $data['name_' . $locale],
                'description' => $data['description_' . $locale],
            ];
            if ($translations['name'] || $translations['description']) {
                $role->saveTranslation($translations, $locale);
            }
        }
        return $role;
    }
    // update data
    public function update(Role $role, array $data)
    {
        $name=$data['name_en']??$data['name_ar'];
        $description=$data['description_en']??$data['description_ar'];
        $role->update([
        'name' => $name,
        'description' => $description,
        ]);
        $role->syncPermissions($data['permissions'] ?? []);
                $locales = config('app.available_locales', ['en', 'ar']);
        foreach ($locales as $locale) {
            $translations = [
                'name' => $data['name_' . $locale],
                'description' => $data['description_' . $locale],
            ];
            if ($translations['name'] || $translations['description']) {
                $role->saveTranslation($translations, $locale);
            }
        }
        return $role;
    }
    // delete data
    public function delete(Role $role)
    {
        $role->delete();
        return $role;
    }

}
