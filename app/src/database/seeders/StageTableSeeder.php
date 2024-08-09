<?php

namespace Database\Seeders;

use App\Models\Stage;
use Illuminate\Database\Seeder;

class StageTableSeeder extends Seeder
{
    public function run(): void
    {
        Stage::create([
            'name' => 'Stage1',
            'limit_time' => 10.0,
            'shuffle_count' => 7
        ]);
        Stage::create([
            'name' => 'Stage2',
            'limit_time' => 20.0,
            'shuffle_count' => 15
        ]);
        Stage::create([
            'name' => 'Stage3',
            'limit_time' => 50.0,
            'shuffle_count' => 31
        ]);
        Stage::create([
            'name' => 'Stage4',
            'limit_time' => 80.0,
            'shuffle_count' => 51
        ]);
        Stage::create([
            'name' => 'Stage5',
            'limit_time' => 120.0,
            'shuffle_count' => 81
        ]);
    }
}
