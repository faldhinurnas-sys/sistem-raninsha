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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');               // siapa yang pesan
            $table->string('customer_name');                     // nama penerima
            $table->string('customer_phone');                    // no HP
            $table->text('customer_address');                    // alamat
            $table->decimal('total_amount', 12, 2)->default(0);  // total
            $table->enum('status', ['pending', 'processing', 'completed', 'cancelled'])
                ->default('pending');                          // status pesanan
            $table->text('note')->nullable();                    // catatan tambahan
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
