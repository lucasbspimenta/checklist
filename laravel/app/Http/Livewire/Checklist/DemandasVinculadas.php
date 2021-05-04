<?php

namespace App\Http\Livewire\Checklist;

use Livewire\Component;

use App\Models\ChecklistItemDemanda;

class DemandasVinculadas extends Component
{
    public $checklist;

    protected $listeners = ['atualizaListaDemandas' => 'atualizar', 'triggerDeleteDemanda' => 'excluir'];
    
    public function render()
    {
        return view('livewire.checklist.demandas-vinculadas');
    }

    public function atualizar() {
        $this->checklist->load('demandas');
    }

    public function excluir($id)
    {
        ChecklistItemDemanda::find($id)->delete();
        $this->checklist->load('demandas');
        $this->dispatchBrowserEvent('triggerDemandaExcluidaSucesso');
    }
}
