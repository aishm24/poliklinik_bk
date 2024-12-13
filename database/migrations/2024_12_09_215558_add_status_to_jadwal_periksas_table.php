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
        Schema::table('jadwal_periksas', function (Blueprint $table) {
            $table->boolean('status')->default(0)->after('jam_selesai'); // Tambahkan kolom status
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jadwal_periksas', function (Blueprint $table) {
            $table->dropColumn('status'); // Hapus kolom status
        });
    }
};
