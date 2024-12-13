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
        Schema::table('daftar_polis', function (Blueprint $table) {
            $table->enum('status', ['Belum diperiksa', 'Sedang diperiksa', 'Sudah diperiksa'])->default('Belum diperiksa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('daftar_polis', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
