<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MstDataPegawai extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_data_pegawai', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('jabatan_id');
            $table->string('nik', 16);
            $table->string('nama_pegawai', 100);
            $table->string('jenis_kelamin', 15);
            $table->date('tanggal_masuk');
            $table->string('status', 50);
            $table->string('photo', 100);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('jabatan_id')->references('id')->on('mst_data_jabatan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mst_data_pegawai');
    }
}
