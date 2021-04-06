<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Administracao\AgendamentoTipo;

class AgendamentoTipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipos = [
            ['nome' => 'Clássico', 'descricao' => 'Visita geral prevista']
           ,['nome' => 'Ampliado', 'descricao' => 'Adicionais realizados na base']
           ,['nome' => 'Me chama que eu vou', 'descricao' => 'A pedido dos gestores']
           ,['nome' => 'Emergencial', 'descricao' => 'Sinistro, Mudanças de Endereço, etc']
        ];

        AgendamentoTipo::insert($tipos);
    }
}
