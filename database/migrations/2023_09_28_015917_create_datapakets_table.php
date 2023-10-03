<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datapakets', function (Blueprint $table) {
            $table->integer('kode_rup');	
            $table->string('satuan_kerja');
            $table->string('nama_paket');
            $table->string('metode_pengadaan');
            $table->string('pdn');
            $table->string('umk');
            $table->string('pradipa');
            $table->string('tgl_kontrak');
            $table->bigInteger('nilai_kontrak');
            $table->string('awal_pelaksanaan');
            $table->string('akhir_pelaksanaan');
            $table->integer('progress');	
            $table->id();
            $table->integer('tahun');	

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('datapakets');
    }
};
