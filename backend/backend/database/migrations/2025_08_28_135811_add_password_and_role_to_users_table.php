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
        Schema::table('users', function (Blueprint $table) {
           if (!Schema::hasColumn('users', 'password')) {
                $table->string('password'); // thêm cột password
            }

            if (!Schema::hasColumn('users', 'role')) {
                $table->string('role')->default('user'); // thêm cột role, mặc định là user
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
             $table->dropColumn(['password', 'role']);
        });
    }
};
