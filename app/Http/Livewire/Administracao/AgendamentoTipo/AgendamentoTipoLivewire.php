<?php

namespace App\Http\Livewire\Administracao\AgendamentoTipo;

use Livewire\Component;

use App\Models\Administracao\AgendamentoTipo;

class AgendamentoTipoLivewire extends Component
{
    public $tipo_id;
    public $tipo;

    public $tipos = [];

    public $exibirModal = false;

    public function rules() {
        return [
            'tipo.nome' => 'required|unique:agendamento_tipos,nome,'.$this->tipo->id,
            'tipo.situacao' => 'boolean',
            'tipo.cor' => 'string',
            'tipo.descricao' => 'string'
            
        ];
    }

    public function messages() {
        return [
            'tipo.nome.required' => 'Nome é obrigatório',
            'tipo.nome.unique' => 'Já existe esse nome cadastrado',
            'tipo.situacao.required' => 'Situação é obrigatório'
        ];
    }

    public function salvar()
    {
        $this->validate();
        $this->tipo->save();
        $this->fechar();

        $this->tipos = AgendamentoTipo::all();

        $this->dispatchBrowserEvent('triggerMensagemSucesso','Tipo de Agendamento gravado com sucesso!');
    }

    public function fechar() {
        $this->exibirModal = false;
    }

    public function delete($id)
    {
        $this->tipo_id = $id;
        AgendamentoTipo::find($id)->delete();
        $this->tipos = AgendamentoTipo::all();
        $this->dispatchBrowserEvent('triggerMensagemSucesso','Tipo de Agendamento excluído com sucesso!');
    }

    public function limparCamposEValidacao() {
        $this->tipo = new AgendamentoTipo();
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function botaoCancelar() {
        $this->limparCamposEValidacao();
        $this->fechar();
    }

    public function editar($tipoId)
    {
        $this->exibirModal = true;
        $this->tipo = AgendamentoTipo::find($tipoId);
    }

    public function mount(AgendamentoTipo $tipo) {
        $this->tipo = $tipo ?? new AgendamentoTipo();
        $this->tipos = AgendamentoTipo::all();
    }

    public function render()
    {
        return view('livewire.administracao.agendamento-tipo.agendamento-tipo-livewire');
    }
}
