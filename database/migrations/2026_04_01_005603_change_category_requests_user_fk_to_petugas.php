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
        Schema::table('category_requests', function (Blueprint $table) {
            if (Schema::hasColumn('category_requests', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->foreign('user_id')->references('id')->on('petugas')->cascadeOnDelete();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('category_requests', function (Blueprint $table) {
            if (Schema::hasColumn('category_requests', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            }
        });
    }
};
