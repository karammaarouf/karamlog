<?php
namespace App\Services;

use App\Models\User;
use Spatie\Permission\Models\Role;
use App\Services\interfaces\GeneralInterface;
use App\Services\interfaces\UserServiceInterface;

class UserService implements UserServiceInterface
{
    // return all data
    public function getAll()
    {
       $users= User::paginate();
        return $users;
    }
    // return search data
    public function getSearch(string $search)
    {
        $users = User::where('name', 'like', "%$search%")
            ->orWhere('email', 'like', "%$search%")
            ->paginate();
        return $users;
    }
    // create data
    public function create(array $data)
    {
        $user = User::query()->create($data);
        $roles=Role::whereIn('id', $data['roles'])->pluck('name')->toArray();
        $user->syncRoles($roles);
        return $user;
    }
    // update data
    public function update(User $user, array $data)
    {
        $user->update($data);
        $roles=Role::whereIn('id', $data['roles'])->pluck('name')->toArray();
        $user->syncRoles($roles);
        return $user;
    }
    // delete data
    public function delete(User $user)
    {
        $user->delete();
        return $user;
    }
    // restore data
    public function restore(User $user)
    {
        $user->restore();
        return $user;
    }
    // force delete data
    public function forceDelete(User $user)
    {
        $user->forceDelete();
        return $user;
    }
    // get trashed data
    public function getTrashed()
    {
        return User::query()->onlyTrashed()->paginate();
    }
    // toggel active
    public function toggelActive(User $user)
    {
        $user->is_active = !$user->is_active;
        $user->save();
        return $user;
    }
}