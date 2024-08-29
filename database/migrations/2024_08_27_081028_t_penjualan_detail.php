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
        Schema::create('t_penjualan_detail', function (Blueprint $table) {
            $table->id('detail_id');
            $table->unsignedBigInteger('penjualan_id')->index();   // membuat foreign key untuk penjualan_id 
            $table->unsignedBigInteger('barang_id')->index();      // membuat foreign key untuk barang_id 
            $table->integer('harga');
            $table->integer('jumlah');
            $table->timestamps();

            // membuat foreign key untuk penjualan_id 
            $table->foreign('penjualan_id')->references('penjualan_id')->on('t_penjualan');

            // membuat foreign key untuk barang_id 
            $table->foreign('barang_id')->references('barang_id')->on('m_barang');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('t_penjualan_detail'); 
    }
};
