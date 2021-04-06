<?php

namespace App\Http\Livewire\Administracao\AgendamentoTipo;

use Livewire\Component;
use App\Models\Administracao\AgendamentoTipo;

class Datatable extends Component
{

    public function render()
    {
        return view('livewire.administracao.agendamento-tipo.datatable', [
            'tipos' => AgendamentoTipo::all(),
        ]);
    }

}
