<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tables', function (Blueprint $table) {

            $table->id(); // Internal system ID

            $table->unsignedInteger('table_number')->unique();
            // Human-readable table number (used in QR & UI)

            $table->timestamps();
            // Useful for future analytics or management
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tables');
    }
};