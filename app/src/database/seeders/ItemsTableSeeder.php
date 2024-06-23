<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;

class ItemsTableSeeder extends Seeder
{
    public function run(): void
    {
        Item::create([
            'name' => '回復薬',
            'type' => 1,
            'value' => 3,
            'desc' => 'ライフを回復する'
        ]);
        Item::create([
            'name' => '超回復薬',
            'type' => 1,
            'value' => 5,
            'desc' => 'ライフを超回復する'
        ]);
        Item::create([
            'name' => '復活の羽',
            'type' => 1,
            'value' => 1,
            'desc' => '一度死んでも復活する'
        ]);
        Item::create([
            'name' => 'しあわせの靴',
            'type' => 2,
            'value' => 10,
            'desc' => 'クリア毎に経験値が加算'
        ]);
    }
}
