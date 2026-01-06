<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('target_keuangan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_target');
            $table->decimal('target_dana', 15, 2);
            $table->decimal('dana_terkumpul', 15, 2)->default(0);
            $table->date('tanggal_mulai');
            $table->date('tanggal_target');
            $table->enum('status', ['proses', 'tercapai'])->default('proses');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('target_keuangan');
    }
};
