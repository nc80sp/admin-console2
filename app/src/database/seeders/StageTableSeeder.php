<?php

namespace Database\Seeders;

use App\Models\Stage;
use Illuminate\Database\Seeder;

class StageTableSeeder extends Seeder
{
    public function run(): void
    {
        Stage::create([
            'name'=>'stage 1',
            'limit_time' => 20.0,
            'asset_url' => ''
        ]);
        Stage::create([
            'name'=>'stage 2',
            'limit_time' => 30.0,
            'asset_url' => ''
        ]);
        Stage::create([
            'name'=>'stage 3',
            'limit_time' => 40.0,
            'asset_url' => ''
        ]);
    }
}
