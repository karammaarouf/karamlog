<?php

namespace App\Services\Interfaces;

use App\Models\User;

interface UserServiceInterface
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
    public function update(User $user, array $data);
    // delete data
    public function delete(User $user);
    // restore data
    public function restore(User $user);
    // force delete data
    public function forceDelete(User $user);
    // get trashed data
    public function getDeleted();
    // toggel active
    public function toggelActive(User $user);
}
