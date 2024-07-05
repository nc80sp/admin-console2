<?php

namespace Database\Factories;

use App\Models\Item;
use App\Models\Mail;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class MailFactory extends Factory
{
    protected $model = Mail::class;

    public function definition(): array
    {
        $itemsCount = Item::All()->count();
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'title' => $this->faker->word(),
            'body' => $this->faker->word(),
            'item_id' => $this->faker->randomNumber(1, $itemsCount),
            'amount' => $this->faker->randomNumber(1, 10)
        ];
    }
}
