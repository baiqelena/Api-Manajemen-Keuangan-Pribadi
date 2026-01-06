<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('investasi', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('jenis_investasi', 100); // saham, reksadana, emas
            $table->string('nama_aset', 150);       // nama saham / produk
            $table->decimal('jumlah_investasi', 15, 2);
            $table->decimal('nilai_awal', 15, 2);
            $table->decimal('nilai_sekarang', 15, 2)->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('investasi');
    }
};
