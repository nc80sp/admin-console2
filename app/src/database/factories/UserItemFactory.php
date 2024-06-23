<?php

namespace Database\Factories;

use App\Models\Item;
use App\Models\User;
use App\Models\UserItem;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class UserItemFactory extends Factory
{
    protected $model = UserItem::class;

    public function definition(): array
    {
        $idsA = User::all()->pluck('id');
        $idsB = Item::all()->pluck('id');
        $matrix = $idsA->crossJoin($idsB);
        $keypair = $this->faker->unique()->randomElement($matrix);
        return [
            'user_id' => $keypair[0],
            'item_id' => $keypair[1],
            'amount' => $this->faker->numberBetween(0, 100),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
