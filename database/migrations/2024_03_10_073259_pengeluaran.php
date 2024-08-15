<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengeluaran', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->enum('jenis_pengeluaran', ['Pengeluaran Harian', 'Pengeluaran Bulanan', 'Pengeluaran Tahunan']);
            $table->string('keterangan', 50)->nullable();
            $table->enum('keperluan', ['Makanan', 'Transportasi', 'Hiburan', 'Tagihan', 'Kesehatan', 'Lainnya']);
            $table->string('jumlah', 250);
            $table->bigInteger('id_users')->unsigned();
            $table->foreign('id_users')->references('id')->on('users');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
