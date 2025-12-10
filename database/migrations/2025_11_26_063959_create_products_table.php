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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');                    // nama kue
            $table->text('description')->nullable();   // deskripsi
            $table->decimal('price', 12, 2);           // harga
            $table->integer('stock')->default(0);      // stok
            $table->string('image')->nullable();       // path gambar
            $table->boolean('is_active')->default(true); // tampil di landing / tidak
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
