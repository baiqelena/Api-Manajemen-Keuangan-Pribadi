<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::table('hutang', function (Blueprint $table) {
        $table->string('nama_pemberi_hutang')->after('id');
        $table->bigInteger('jumlah_hutang')->nullable();
        $table->text('keterangan')->nullable();
    });
}

public function down()
{
    Schema::table('hutang', function (Blueprint $table) {
        $table->dropColumn([
            'nama_pemberi_hutang',
            'jumlah_hutang',
            'keterangan'
        ]);
    });
}
};