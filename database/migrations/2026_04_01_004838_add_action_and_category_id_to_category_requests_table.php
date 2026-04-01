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
            if (!Schema::hasColumn('category_requests', 'action')) {
                $table->enum('action', ['create', 'update', 'delete'])->default('create')->after('name');
            }
            if (!Schema::hasColumn('category_requests', 'category_id')) {
                $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete()->after('id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('category_requests', function (Blueprint $table) {
            if (Schema::hasColumn('category_requests', 'action')) {
                $table->dropColumn('action');
            }
            if (Schema::hasColumn('category_requests', 'category_id')) {
                $table->dropForeign(['category_id']);
                $table->dropColumn('category_id');
            }
        });
    }
};
