<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hutang', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pemberi_hutang');
            $table->date('tanggal_pinjam'); // kolom yang sebelumnya hilang
            $table->decimal('jumlah', 12, 2)->default(0); // jumlah hutang, bisa diisi 0 default
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hutang');
    }
};
