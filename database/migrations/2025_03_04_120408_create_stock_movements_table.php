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
        Schema::create('stock_movements', function (Blueprint $table) {
            $table->id();
            
            // Foreign key to product
            $table->foreignId('product_id')
                  ->constrained()
                  ->onDelete('cascade');
            
            // Quantity changed (positive/negative)
            $table->integer('quantity');
            
            // Movement type (in/out/adjustment)
            $table->enum('type', ['in', 'out', 'adjustment']);
            
            // Reason for movement
            $table->string('reason')->nullable();
            
            // Reference to related order (if applicable)
            $table->foreignId('order_id')
                  ->nullable()
                  ->constrained()
                  ->onDelete('set null');
            
            // User who initiated the movement
            $table->foreignId('user_id')
                  ->nullable()
                  ->constrained()
                  ->onDelete('set null');
            
            // Indexes for faster queries
            $table->index('product_id');
            $table->index('type');
            $table->index('created_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_movements');
    }
};
