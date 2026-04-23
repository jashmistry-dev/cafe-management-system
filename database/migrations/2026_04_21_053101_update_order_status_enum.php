<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        DB::statement("
        ALTER TABLE orders 
        MODIFY status ENUM(
            'waiting_payment',
            'pending',
            'preparing',
            'ready',
            'completed'
        ) DEFAULT 'waiting_payment'
    ");
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
