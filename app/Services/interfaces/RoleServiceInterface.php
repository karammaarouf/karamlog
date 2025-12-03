<?php

namespace App\Services\Interfaces;

use Spatie\Permission\Models\Role;

interface RoleServiceInterface
{
    // return all data
    public function getAll();
    // return search data
    public function getSearch(string $search);
    // create data
    public function create(array $data);
    // update data
    public function update(Role $role, array $data);
    // delete data
    public function delete(Role $role);

}
