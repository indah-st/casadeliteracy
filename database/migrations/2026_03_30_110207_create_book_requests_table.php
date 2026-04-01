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
   Schema::create('book_requests', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->cascadeOnDelete();
    $table->foreignId('book_id')->nullable()->constrained('books')->nullOnDelete();
    $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
    $table->string('judul');
    $table->string('penulis');
    $table->string('penerbit')->nullable();
    $table->year('tahun')->nullable();
    $table->integer('stok')->nullable();
    $table->text('sinopsis')->nullable();
    $table->integer('jumlah_halaman')->nullable();
    $table->string('cover')->nullable();
    $table->enum('action', ['create', 'update', 'delete'])->default('create');
    $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
    $table->timestamps();

});
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_requests');
    }
};
