<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicationsTable extends Migration
{
    public function up()
    {
        Schema::create('publications', function (Blueprint $table) {
            $table->id();
            $table->string('nama_dokumen');
            $table->string('slug')->unique();
            $table->string('produsen_data');
            $table->date('rencana_rilis')->nullable();
            $table->date('tanggal_rilis')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('image')->nullable();
            $table->string('file')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('publications');
    }
};