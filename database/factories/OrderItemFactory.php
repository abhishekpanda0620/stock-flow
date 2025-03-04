<?php

namespace Database\Factories;

use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = OrderItem::class;

    public function definition(): array
    {
        return [
            'order_id' => fn() => \App\Models\Order::factory()->create()->id,
            'product_id' => fn() => \App\Models\Product::factory()->create()->id,
            'quantity' => $this->faker->numberBetween(1, 10),
            'unit_price' => fn($attributes) => \App\Models\Product::find($attributes['product_id'])->price,
        ];

    }
}
