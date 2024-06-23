<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        $scheduled_date = $this->faker->dateTimeBetween('+1day', '+1year');
        return [
            'name' => $this->faker->unique()->name(),
            'level' => $this->faker->randomNumber(2),
            'exp' => $this->faker->randomNumber(5),
            'life' => $this->faker->randomNumber(1),
            'created_at' => $scheduled_date->format('Y-m-d H:i:s'),
            'updated_at' => $scheduled_date->modify('+1hour')->format('Y-m-d H:i:s'),
        ];
    }
}
