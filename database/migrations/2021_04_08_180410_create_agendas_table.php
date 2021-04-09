<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agendas', function (Blueprint $table) {
            $table->id();
            $table->string('descricao');
            $table->date('inicio');
            $table->date('final');

            $table->unsignedBigInteger('imovel_id')->nullable();
            //$table->foreign('agendamento_tipos_id')->references('id')->on('agendamento_tipos');

            $table->unsignedBigInteger('agendamento_tipos_id')->nullable();
            $table->foreign('agendamento_tipos_id')->references('id')->on('agendamento_tipos');

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
        Schema::dropIfExists('agendas');
    }
}
