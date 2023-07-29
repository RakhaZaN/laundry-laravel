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
        Schema::table('pesanan', function (Blueprint $table) {
            $table->enum('status', ['menunggu penjemputan', 'dijemput', 'diproses', 'diantar', 'selesai', 'dibatalkan'])->default('menunggu penjemputan');
            $table->decimal('jumlah')->default(0)->change();
            $table->integer('total_biaya')->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pesanan', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
