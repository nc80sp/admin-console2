<?php

namespace Database\Seeders;

use App\Models\Account;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Account::create([
            'name' => 'jobi',
            'password' => Hash::make('jobi')
        ]);
        Account::create([
            'name' => 'chiba',
            'password' => Hash::make('nobu')
        ]);

        Account::factory(2)->create();
    }
}
