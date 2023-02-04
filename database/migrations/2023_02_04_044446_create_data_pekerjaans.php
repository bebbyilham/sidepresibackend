<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataPekerjaans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_pekerjaans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('status_kepegawaian', ['pns', 'non pns']);
            $table->string('nip');
            $table->string('no_sk_pengangkatan');
            $table->string('ruang_kerja');
            $table->string('ruang_kerja_lain');
            $table->string('jabatan');
            $table->string('total_masa_kerja');
            $table->date('tmt');
            $table->string('riwayat_penempatan');
            $table->string('kesesuaian');
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
        Schema::dropIfExists('data_pekerjaans');
    }
}
