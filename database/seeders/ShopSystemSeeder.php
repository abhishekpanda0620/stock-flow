<?php

namespace Database\Seeders;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\StockMovement;
use App\Models\Receipt;
use Illuminate\Database\Seeder;

class ShopSystemSeeder extends Seeder
{
    public function run()
    {
        // Create Customers
        $customers = Customer::factory()->count(5)->create();

        // Create Products with Initial Stock
        $products = Product::factory()->count(10)->create();

        // Create Orders with Items
        $orders = Order::factory()->count(20)->create([
            'customer_id' => fn() => $customers->random()->id,
        ]);

        $orders->each(function ($order) use ($products) {
            $orderItems = OrderItem::factory()->count(rand(1, 5))->create([
                'order_id' => $order->id,
                'product_id' => fn() => $products->random()->id,
                'unit_price' => fn($attributes) => Product::find($attributes['product_id'])->price,
            ]);

            // Update Order Total
            $order->update([
                'total_amount' => $orderItems->sum(fn($item) => $item->quantity * $item->unit_price),
            ]);

            // Generate Receipt for Completed Orders
            if ($order->status === 'completed') {
                Receipt::factory()->create([
                    'order_id' => $order->id,
                ]);

                // Create Stock Movements for Completed Orders
                $orderItems->each(function ($item) use ($order) {
                    StockMovement::create([
                        'product_id' => $item->product_id,
                        'quantity' => $item->quantity,
                        'type' => 'out',
                        'reason' => 'Order #' . $order->id,
                        'order_id' => $order->id,
                        'user_id' => 1, // Assuming user_id 1 is the admin
                    ]);
                });
            }
        });

        // Create Additional Stock Movements
        StockMovement::factory()->count(30)->create([
            'product_id' => fn() => $products->random()->id,
            'type' => fn() => rand(0, 1) ? 'in' : 'out',
            'reason' => fn() => ['Supplier delivery', 'Damaged goods', 'Manual adjustment'][rand(0, 2)],
            'user_id' => 1,
        ]);
    }
}