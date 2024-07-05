<?php

namespace Database\Factories;

use App\Models\Mail;
use App\Models\User;
use App\Models\UserMail;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class UserMailFactory extends Factory
{
    protected $model = UserMail::class;

    public function definition(): array
    {
        $countUser = User::All()->count();
        $countMail = Mail::All()->count();
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'user_id' => $this->faker->numberBetween(1, $countUser),
            'mail_id' => $this->faker->numberBetween(1, $countMail),
            'received' => false,
        ];
    }
}
