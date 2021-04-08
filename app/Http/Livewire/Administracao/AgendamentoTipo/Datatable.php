<?php

namespace App\Http\Livewire\Administracao\AgendamentoTipo;

use Livewire\Component;
use App\Models\Administracao\AgendamentoTipo;

class Datatable extends Component
{
    public $tipos = [];

    public function mount(){
        $this->tipos = AgendamentoTipo::all();
    }

    public function render()
    {
        return view('livewire.administracao.agendamento-tipo.datatable');
    }
}
