<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePinjamBukusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pinjam_bukus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nopinjam');
            $table->integer('id_anggota');
            $table->integer('id_buku');
            $table->date('tanggal_pinjam');
            $table->date('tglhrskbl');
            $table->date('tglkbl')->nullable();
            $table->double('denda')->default(0);
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
        Schema::dropIfExists('pinjam_bukus');
    }
}
