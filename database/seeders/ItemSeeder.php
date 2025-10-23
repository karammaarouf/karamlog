<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Item::create([
            'name' => 'Item 1',
            'description' => 'Description 1',
            'price' => 100.00,
            'code' => 'ITEM001',
            'quantity' => 10,
            'is_active' => true,
            'discount' => 0.00,
        ]);
        Item::create([
            'name' => 'Item 2',
            'description' => 'Description 2',
            'price' => 200.00,
            'code' => 'ITEM002',
            'quantity' => 20,
            'is_active' => true,
            'discount' => 10.00,
        ]);
    }
}
