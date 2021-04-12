<?php

namespace App\Http\Livewire\Agenda;
use Illuminate\Support\Carbon;
use Livewire\Component;
use App\Models\Agenda;
use App\Models\Administracao\AgendamentoTipo;

class ModalLivewire extends Component
{
    public $agenda;
    public $tiposagendamentos = [];
    public $exibirModal = false;

    protected $listeners = ['abrirModalAgenda' => 'abrirModal'];

    public function rules() {
        return [
            'agenda.imovel_id' => 'required|integer',
            'agenda.inicio' => 'required|date',
            'agenda.final' => 'date',
            'agenda.agendamento_tipos_id' => 'required|integer',
            'agenda.descricao' => 'string'
        ];
    }

    public function messages() {
        return [
            'agenda.imovel_id.required' => 'Imóvel é obrigatório',
            'agenda.agendamento_tipos_id.required' => 'Tipo de agendamento é obrigatório',
            'agenda.inicio.required' => 'Início é obrigatório',
            'agenda.ordem.integer' => 'Deve um número inteiro'
        ];
    }

    public function render()
    {
        return view('livewire.agenda.modal-livewire');
    }

    public function mount(Agenda $agenda) 
    {
        $this->agenda = $agenda ?? new Agenda();
        $this->tiposagendamentos = AgendamentoTipo::where('situacao','=',1)->get();
    }

    public function abrirModal($id=null, $inicio=null, $final=null) 
    {
        $this->exibirModal = true;
        $this->agenda = Agenda::findOrNew($id);
        $this->agenda->inicio = $this->agenda->inicio ?? (Carbon::canBeCreatedFromFormat($inicio, 'Y-m-d') ? $inicio : null);
        $this->agenda->final = $this->agenda->final ?? (Carbon::canBeCreatedFromFormat($final, 'Y-m-d', ) ? $final : null);
    }

    public function botaoCancelar()
    {
        $this->agenda = new Agenda();
        $this->exibirModal = false;
    }

    public function salvar()
    {
        //dump($this->agenda);
        $this->validate();
        $this->agenda->save();

        $this->dispatchBrowserEvent('triggerAgendaGravadaSucesso',$this->agenda->inicio);
        $this->botaoCancelar();
    }
}

