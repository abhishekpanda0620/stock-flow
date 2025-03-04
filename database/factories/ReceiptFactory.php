<?php

namespace Database\Factories;

use App\Models\Receipt;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Receipt>
 */
class ReceiptFactory extends Factory
{
    protected $model = Receipt::class;

    public function definition()
    {
        return [
            'generated_at' => $this->faker->dateTime,
            'receipt_number' => $this->faker->uuid,
            'order_id' => fn() => \App\Models\Order::factory()->create()->id,
            'content' => $this->faker->paragraph,
            'pdf_path' => 'receipts/' . $this->faker->uuid . '.pdf',
        ];
    }
}
