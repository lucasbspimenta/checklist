<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriarViewUnidades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        SELECT        
            id_unidade as id,
            cUnidade as codigo,
            cdv as codigoDv,
            cTipo as tipo,
            cTipo_PV as tipoPv,
            cNome as nome,
            cEndereco_Cidade as municipio,
            cEndereco_UF as uf,
            cBairro as bairro,
            cEndereco as endereco,
            cSituacao as situacao,
            cEmail as email,
            cCEP as cep,
            cSubordinacao as codigoSubordinacao,
            cSubordinacao_dv as codigoDvSubordinacao,
            cSubordinacao_Tipo as tipoSubordinacao,
            cSubordinacao_Nome as nomeSubordinacao,
            csev_codigo_especifico as codigoSev,
            csev_dv as codigoDvSev,
            csev_tipo as tipoSev,
            csev_nome as nomeSev,
            csev_nome_completo as nomeCompletoSev
        FROM            
            ATENDIMENTO.dbo.UNIDADES_BUSCA
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP VIEW [dbo].[unidades]');
    }
}
