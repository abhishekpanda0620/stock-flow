<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('notes')->nullable();
            $table->string('image')->nullable();
            $table->timestamp('last_order_at')->nullable();
            $table->timestamp('last_paid_at')->nullable();
            $table->timestamp('last_visited_at')->nullable();
            $table->integer('total_orders')->default(0);
            $table->decimal('total_spent', 8, 2)->default(0);
            $table->integer('total_items')->default(0);
            $table->integer('total_quantity')->default(0);
            $table->integer('total_discounts')->default(0);
            $table->integer('total_returns')->default(0);
            $table->integer('total_refunds')->default(0);
            $table->integer('total_cancellations')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
