<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('laporan_keuangan', function (Blueprint $table) {
            $table->id();
            $table->year('tahun');
            $table->tinyInteger('bulan');
            $table->decimal('total_pengeluaran', 15, 2)->default(0);
            $table->decimal('total_investasi', 15, 2)->default(0);
            $table->decimal('saldo_akhir', 15, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporan_keuangan');
    }
};
