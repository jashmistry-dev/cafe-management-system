<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {

            $table->id(); // Primary key

            $table->string('name'); // Customer name for invoice display

            $table->string('mobile', 15)->unique(); 
            // Unique because this is the business identity for repeat customers

            $table->timestamps(); 
            // Needed for analytics like "new customers this month"
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
