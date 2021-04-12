<?php

namespace App\Http\Livewire\Checklist\Old;

use Livewire\Component;
use Illuminate\Support\Arr;

use App\Models\Agenda;
use App\Models\ChecklistItemResposta;

class ItensVinculados extends Component
{   
    public $agenda;
    public $itens_situacoes = [];

    public function rules() {
        return [
            'agenda.checklist.itens.*.resposta' => 'integer'
        ];
    }

    public function getChecklistProperty()
    {
        dump('Cheguei aqui');
        return Checklist::where('agenda_id',$this->agenda->id);
    }

    public function mount(Agenda $agenda) {

        $this->agenda = $agenda;
        $this->atualizaItensSituacoes();
    }

    public function dehydrate() {
        //$this->agenda->load('checklist');
        //dump($this->agenda->checklist);
    }

    public function render()
    {
        return view('livewire.checklist.old.itens-vinculados',[
            'agenda' => $this->agenda,
        ]
        );
    }

    private function atualizaItensSituacoes() {
        $this->itens_situacoes = (!$this->agenda->checklist->itens) ?: Arr::pluck($this->agenda->checklist->itens->toArray(),'resposta', 'id');
    }

    public function salvar() 
    {
        // Invertendo valores para realizar menos queries no banco
        $invertido = array();

        foreach($this->itens_situacoes as $id => $valor) {
            $invertido[$valor][] = $id;
        }
        
        foreach($invertido as $valor => $ids) {
            $affected_rows = ChecklistItemResposta::whereIn('id', $ids)->update(['resposta' => $valor]);
        }
        $this->agenda->checklist->itens->fresh();
        $this->atualizaItensSituacoes();
    }
}
