<?php

namespace Database\Factories;

use App\Models\Follow;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class FollowFactory extends Factory
{
    protected $model = Follow::class;

    public function definition(): array
    {
        $idsA = User::all()->pluck('id');
        $idsB = User::all()->pluck('id');
        $matrix = $idsA->crossJoin($idsB);
        $keypair = $this->faker->unique()->randomElement($matrix);
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'user_id' => $keypair[0],
            'follow_user_id' => $keypair[1],
        ];
    }
}
