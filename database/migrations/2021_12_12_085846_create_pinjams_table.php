<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePinjamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pinjams', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('buku_id');
            $table->string('peminjam');
            $table->string('jaminan');
            $table->string('tanggal_pinjam');
            $table->string('tanggal_kembali');
            $table->string('flag_kembali');
            $table->string('denda')->nullable();
            $table->timestamps();

            $table->foreign('buku_id')->references('id')->on('raks')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pinjams');
    }
}
