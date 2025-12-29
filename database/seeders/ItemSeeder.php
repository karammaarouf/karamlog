<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\ItemDetail;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Item::factory()
            ->count(5)
            ->has(ItemDetail::factory(), 'details')
            ->create();
    }
}
