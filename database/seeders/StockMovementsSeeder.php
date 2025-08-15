<?php

namespace Database\Seeders;

use App\Models\ResourceItem;
use App\Models\StockMovement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StockMovementsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = ResourceItem::all();

        foreach ($items as $item) {
            StockMovement::create([
                'resource_item_id'=>$item->id,
                'type'=>'in',
                'quantity'=>$item->current_stock,
                'reference'=>'Initial stock',
                'remarks'=>'Seeded initial stock'
            ]);
        }
    }
}
