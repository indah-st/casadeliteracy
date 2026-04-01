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
    Schema::create('books', function (Blueprint $table) {
        $table->id();
        $table->string('judul');
        $table->string('penulis');
        $table->string('penerbit');
        $table->year('tahun');
        $table->integer('stok');

        // FK KATEGORI
        $table->foreignId('category_id')
              ->nullable()
              ->constrained('categories')
              ->nullOnDelete();

        $table->json('genre')->nullable();
        $table->string('cover')->nullable();
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('books');
}
};