<?php

namespace App\Http\Livewire\Agenda;

use Livewire\Component;
use App\Models\Agenda;
use App\Models\Administracao\ChecklistItem;

class VisualizarLivewire extends Component
{
    public $agenda;
    public $exibirModal = false;
    public $conta_itens_ativos = 0;

    protected $listeners = ['abrirModalVerAgenda' => 'abrirModal', 'triggerDeleteAgenda' => 'excluir'];

    public function render()
    {
        return view('livewire.agenda.visualizar-livewire');
    }

    public function mount() 
    {
        $this->agenda = new Agenda();
        $this->conta_itens_ativos = ChecklistItem::where('situacao','A')->count();
    }

    public function abrirModal($id=null) 
    {
        $this->exibirModal = true;
        $this->agenda = Agenda::with('tipo')->findOrFail($id);
    }

    public function botaoCancelar()
    {
        $this->agenda = new Agenda();
        $this->exibirModal = false;
    }

    public function excluir($id)
    {
        Agenda::find($id)->delete();
        $this->exibirModal = false;
        $this->agenda = new Agenda();
        $this->dispatchBrowserEvent('triggerAgendaExcluidaSucesso');
    }
}
