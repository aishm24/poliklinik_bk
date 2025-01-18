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
        Schema::create('konsultasis', function (Blueprint $table) {
            $table->id();
            $table->string('subject', 100)->nullable();
            $table->text('pertanyaan')->nullable();
            $table->text('jawaban')->nullable();
            $table->dateTime('tgl_konsultasi');
            $table->unsignedBigInteger('id_pasien')->nullable();
            $table->unsignedBigInteger('id_dokter')->nullable();
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
        Schema::dropIfExists('konsultasis');
    }
};
