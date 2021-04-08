<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChecklistItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checklist_items', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('descricao')->nullable();
            $table->boolean('situacao')->default(true);
            $table->string('cor', 7)->nullable();

            $table->unsignedBigInteger('checklist_items_id')->nullable();
            $table->foreign('checklist_items_id')->references('id')->on('checklist_items');

            $table->integer('ordem')->nullable();

            $table->unique(['nome', 'checklist_items_id']);

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
        Schema::dropIfExists('checklist_items');
    }
}
