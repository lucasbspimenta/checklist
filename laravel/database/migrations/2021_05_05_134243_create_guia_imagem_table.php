<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuiaImagemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guia_imagem', function (Blueprint $table) {

            $table->unsignedBigInteger('guia_id');
            $table->foreign('guia_id')->references('id')->on('guia')->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('imagem-id');
            $table->foreign('imagem')->references('id')->on('imagem')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guia_imagem');
    }
}
