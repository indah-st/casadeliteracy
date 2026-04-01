<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::table('books', function (Blueprint $table) {
        $table->dropForeign(['category_id']);
        $table->dropColumn('category_id');
    });
}

    public function down(): void
    {
        DB::statement('ALTER TABLE books ADD COLUMN IF NOT EXISTS category_id BIGINT UNSIGNED NULL');
        Schema::table('books', function (Blueprint $table) {
            $table->foreign('category_id')->nullable()->references('id')->on('categories')->onDelete('cascade');
        });
    }
    };
