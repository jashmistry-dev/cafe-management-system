<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {

            $table->id();

            // Which table placed the order
            $table->foreignId('table_id')
                  ->constrained()
                  ->cascadeOnDelete();

            // Customer added at billing time
            $table->foreignId('customer_id')
                  ->nullable()
                  ->constrained()
                  ->nullOnDelete();

            // Staff who handled the order
            $table->foreignId('staff_id')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();

            // Order lifecycle status
            $table->enum('status', [
                'pending',
                'preparing',
                'ready',
                'completed',
                'paid'
            ])->default('pending');

            // Final bill amount
            $table->decimal('total_amount', 10, 2)->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};