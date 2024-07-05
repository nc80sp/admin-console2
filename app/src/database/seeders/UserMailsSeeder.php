<?php

namespace Database\Seeders;

use App\Models\UserMail;
use Illuminate\Database\Seeder;

class UserMailsSeeder extends Seeder
{
    public function run(): void
    {
        UserMail::factory(140)->create();
    }
}
