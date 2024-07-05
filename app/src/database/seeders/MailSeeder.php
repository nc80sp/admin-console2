<?php

namespace Database\Seeders;

use App\Models\mail;
use Illuminate\Database\Seeder;

class MailSeeder extends Seeder
{
    public function run(): void
    {
        Mail::factory(20)->create();
    }
}
