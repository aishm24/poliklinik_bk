<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('obats', function (Blueprint $table) {
            $table->string('nama_obat', 255)->change();
            $table->string('kemasan', 100)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nama_tabel', function (Blueprint $table) {
            // Ganti panjang sebelumnya jika diketahui
            $table->string('nama_obat', 100)->change();
            $table->string('kemasan', 50)->change();
        });
    }
};
