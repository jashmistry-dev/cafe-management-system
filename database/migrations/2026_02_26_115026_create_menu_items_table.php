<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menu_items', function (Blueprint $table) {

            $table->id();

            $table->string('name');

            $table->decimal('price', 8, 2);
            // Current selling price

            $table->foreignId('category_id')
                  ->constrained()
                  ->cascadeOnDelete();
            // FK → categories

            $table->boolean('is_available')->default(true);
            // Admin can disable item

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menu_items');
    }
};