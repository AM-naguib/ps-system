<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            ['name' => 'قهوة', 'price' => 15, 'user_id' => 1],
            ['name' => 'شاي', 'price' => 7, 'user_id' => 1],
            ['name' => 'سوبيا', 'price' => 12, 'user_id' => 1],
            ['name' => 'كركديه', 'price' => 10, 'user_id' => 1],
            ['name' => 'خروب', 'price' => 10, 'user_id' => 1],
            ['name' => 'حلبة', 'price' => 6, 'user_id' => 1],
            ['name' => 'عرق سوس', 'price' => 12, 'user_id' => 1],
            ['name' => 'تمر هندي', 'price' => 10, 'user_id' => 1],
            ['name' => 'ليمون بالنعناع', 'price' => 20, 'user_id' => 1],
            ['name' => 'قرفة باللبن', 'price' => 15, 'user_id' => 1]
        ];


        foreach ($items as $item) {
            Item::create($item);
        }

    }
}
