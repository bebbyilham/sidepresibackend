<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIdentitasProfesis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('identitas_profesis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('ijazah_terakhir');
            $table->string('no_ijazah_terakhir');
            $table->string('tahun_ijazah_terakhir');
            $table->string('nama_institusi');
            $table->string('jenis_profesi');
            $table->string('jenjang_profesi');
            $table->string('no_kta');
            $table->date('tgl_daftar_anggota');
            $table->string('no_str');
            $table->date('str_berlaku');
            $table->string('no_sikp');
            $table->date('sikp_berlaku');
            $table->string('no_penugasan');
            $table->date('no_penugasan_berlaku');
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
        Schema::dropIfExists('identitas_profesis');
    }
}
