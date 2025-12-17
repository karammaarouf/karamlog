<?php

namespace App\Services\Interfaces;

use App\Models\Item;

interface ItemServiceInterface
{
    public function getAll();
    public function getSearch(string $query);
    public function getCounts();
    public function create(array $data);
    public function update(array $data, Item $item);
    public function toggleActive(Item $item);
    public function delete(Item $item);
    public function getDeleted();
    public function restore(Item $item);
    public function forceDelete(Item $item);
    public function restoreAll();
    public function forceDeleteAll();
}
