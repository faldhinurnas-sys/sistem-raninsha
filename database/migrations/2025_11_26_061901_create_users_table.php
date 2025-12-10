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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');                       // nama lengkap (opsional dipakai)
            $table->string('username')->unique();         // username untuk login
            $table->string('password');                   // password hash
            $table->enum('role', ['admin', 'user'])->default('user'); // role (kalau mau dipakai nanti)
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
