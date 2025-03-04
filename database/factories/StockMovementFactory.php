<?php

namespace Database\Factories;

use App\Models\StockMovement;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StockMovement>
 */
class StockMovementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = StockMovement::class;

    public function definition(): array
    {
        return [
            'product_id' => fn() => \App\Models\Product::factory()->create()->id,
            'quantity' => $this->faker->numberBetween(1, 100),
            'type' => $this->faker->randomElement(['in', 'out']),
            'reason' => $this->faker->sentence,
            'order_id' => fn() => \App\Models\Order::factory()->create()->id,
            'user_id' => 1, // Assuming user_id 1 is the admin
        ];
    }
}
