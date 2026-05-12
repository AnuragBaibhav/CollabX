<?php

namespace Database\Factories;

use App\Models\OtpVerification;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OtpVerification>
 */
class OtpVerificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'email' => fake()->unique()->safeEmail(),
            'otp' => str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT),
            'attempts' => 0,
            'expires_at' => now()->addMinutes(10),
        ];
    }

    /**
     * State for expired OTP.
     */
    public function expired(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'expires_at' => now()->subMinutes(5),
            ];
        });
    }

    /**
     * State for verified OTP.
     */
    public function verified(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'verified_at' => now(),
            ];
        });
    }

    /**
     * State for max attempts reached.
     */
    public function maxAttempts(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'attempts' => 5,
            ];
        });
    }
}
