<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            'order_number' => 'ORD' . $this->faker->unique()->randomNumber(6),
            'customer_id' => fn() => \App\Models\Customer::factory()->create()->id,
            'total_amount' => $this->faker->randomFloat(2, 50, 1000),
            'status' => $this->faker->randomElement(['pending', 'processing', 'completed', 'cancelled']),
            'payment_method' => $this->faker->randomElement(['cash', 'card', 'online']),
        ];
    }
}
