<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnidadesPorEquipeView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('DROP VIEW IF EXISTS [dbo].[equipe_unidades]');
        DB::unprepared("
        CREATE VIEW [dbo].[equipe_unidades]
        as
            SELECT
            DISTINCT 
            [equipe_codigo],
            [equipe_nome],
            [unidade_codigo],
            [equipe_gestor]
            FROM [dbo].[usuario_perfil] up
            INNER JOIN [dbo].[usuario_unidades] un on up.matricula = un.matricula
        ");

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP VIEW [dbo].[equipe_unidades]');
    }
}
