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
        Schema::create('pemasukan', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->enum('jenis_pemasukan', ['Pemasukan Harian', 'Pemasukan Bulanan', 'Pemasukan Tahunan']);
            $table->string('keterangan', 50)->nullable();
            $table->enum('sumber', ['Gaji', 'Investasi', 'Bisnis', 'Hadiah', 'Lainnya']);
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
