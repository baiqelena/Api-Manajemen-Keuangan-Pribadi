<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengeluaran', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('kategori', 100);
            $table->text('deskripsi')->nullable();
            $table->decimal('jumlah', 15, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengeluaran');
    }
};
