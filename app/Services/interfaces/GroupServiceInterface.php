<?php

namespace App\Services\Interfaces;

use App\Models\Group;

interface GroupServiceInterface
{
    public function getAll();
    public function getSearch(string $query);
    public function getCounts();
    public function create(array $data);
    public function update(array $data, Group $group);
    public function toggleActive(Group $group);
    public function delete(Group $group);
    public function getDeleted();
    public function restore(Group $group);
    public function forceDelete(Group $group);
}
