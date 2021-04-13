<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChecklistItemDemandasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checklist_item_demandas', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('sistema_id');
            $table->foreign('sistema_id')->references('id')->on('demanda_sistemas');

            $table->integer('demanda_id')->nullable();
            $table->string('demanda_url')->nullable();
            $table->string('demanda_situacao')->nullable();

            $table->longText('descricao')->nullable();

            $table->unsignedBigInteger('checklist_item_resposta_id');
            $table->foreign('checklist_item_resposta_id')->references('id')->on('checklist_item_respostas');

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
        Schema::dropIfExists('checklist_item_demandas');
    }
}
