<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengaduanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengaduan', function (Blueprint $table) {
            $table->id();
            $table->string('judul',255);
            $table->timestamp('tgl_pengaduan');
            $table->char('nik',16)->index();
            $table->string('lokasi',255);
            $table->text('isi_laporan');
            $table->string('foto',255);
            $table->enum('status', ['0', 'proses', 'selesai'])->default('0');

            $table->foreign('nik')->references('nik')->on('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengaduan');
    }
}
