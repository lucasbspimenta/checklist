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
            $table->string('descricao')->nullable();
            $table->date('inicio');
            $table->date('final');

            $table->unsignedBigInteger('unidade_id');
            //$table->foreign('unidade_id')->references('id')->on('unidades'); Por ser VIEW não pode ter CONSTRAINS

            $table->unsignedBigInteger('agendamento_tipos_id');
            $table->foreign('agendamento_tipos_id')->references('id')->on('agendamento_tipos');

            $table->bigInteger('created_by')->nullable()->unsigned();
            $table->foreign('created_by')->references('id')->on('users');
            $table->bigInteger('updated_by')->nullable()->unsigned();
            $table->foreign('updated_by')->references('id')->on('users');

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
