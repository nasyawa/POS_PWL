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
        Schema::create('t_stok', function (Blueprint $table) {
            $table->id('stok_id');
            $table->unsignedBigInteger('barang_id')->index();   // membuat foreign key untuk barang_id 
            $table->unsignedBigInteger('user_id')->index();     // membuat foreign key untuk user_id 
            $table->datetime('stok_tanggal');
            $table->integer('stok_jumlah');
            $table->timestamps();

            // membuat foreign key untuk barang_id 
            $table->foreign('barang_id')->references('barang_id')->on('m_barang');

            // membuat foreign key untuk user_id 
            $table->foreign('user_id')->references('user_id')->on('m_user');
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('t_stok');
    }
};
