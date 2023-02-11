<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataPelatihans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_pelatihans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('jenis_pelatihan', ['pelatihan wajib', 'kegiatan pengembangan diri', 'pelatihan sesuai area kopetensi']);
            $table->string('nama_pelatihan');
            $table->string('tahun_pelaksanaan');
            $table->string('jumlah_ipl');
            $table->string('jumlah_skp');
            $table->string('berlaku');
            $table->enum('status_pelatihan', ['aktif', 'tidak aktif']);
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
        Schema::dropIfExists('data_pelatihans');
    }
}
