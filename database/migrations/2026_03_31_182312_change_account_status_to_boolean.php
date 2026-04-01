<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up()
    {
        DB::statement("
            UPDATE users 
            SET account_status = CASE 
                WHEN account_status = 'active' THEN 1
                WHEN account_status = 'deactive' THEN 0
            END
        ");

        Schema::table('users', function (Blueprint $table) {
            $table->boolean('account_status')->default(1)->change();
        });
    }

    public function down()
    {
        // revert back (optional)
        Schema::table('users', function (Blueprint $table) {
            $table->string('account_status')->change();
        });

        DB::statement("
            UPDATE users 
            SET account_status = CASE 
                WHEN account_status = 1 THEN 'active'
                WHEN account_status = 0 THEN 'deactive'
            END
        ");
    }
};