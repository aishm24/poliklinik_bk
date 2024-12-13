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
            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->enum('role', ['admin', 'dokter', 'pasien'])->default('pasien');
            $table->unsignedBigInteger('id_dokter')->nullable(); 
            $table->unsignedBigInteger('id_pasien')->nullable(); 
            $table->timestamps();

            $table->foreign('id_dokter')->references('id')->on('dokters')->onDelete('cascade');
            $table->foreign('id_pasien')->references('id')->on('pasiens')->onDelete('cascade');
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
