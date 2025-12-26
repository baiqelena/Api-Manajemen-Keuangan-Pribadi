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
        Schema::create('hutang', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hutang');
        Schema::create('hutang', function (Blueprint $table) {
    $table->id();
    $table->string('nama_pemberi_hutang');
    $table->date('tanggal_pinjam');
    $table->text('keterangan')->nullable();
    $table->timestamps();
});


    }
};
