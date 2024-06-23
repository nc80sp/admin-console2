<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserItem;
use Illuminate\Database\Seeder;

class UserItemsTableSeeder extends Seeder
{
    public function run(): void
    {
        UserItem::factory(140)->create();
    }
}
