<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MstDataJabatan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_data_jabatan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_jabatan', 120);
            $table->bigInteger('gaji_pokok');
            $table->bigInteger('tj_transport');
            $table->bigInteger('uang_makan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mst_data_jabatan');
    }
}
