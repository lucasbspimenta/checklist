<?php

namespace App\Http\Livewire\Checklist;

use Livewire\Component;

use App\Models\DemandaSistema;
use App\Models\ChecklistItemResposta;
use App\Models\ChecklistItemDemanda;

class DemandaForm extends Component
{
    public $sistemas = [];
    public $categorias = [];
    public $subcategorias = [];
    public $itens = [];
    public $checklistItem;

    public $sistema;

    public $sistemaSelecionado;
    public $categoriaSelecionado;
    public $subcategoriaSelecionado;
    public $itemSelecionado;
    public $descricao;

    public function rules() {
        return [
            'descricao' => 'required',
            'itemSelecionado' => 'required'
        ];
    }

    public function messages() {
        return [
            'descricao.required' => 'Descrição é obrigatória',
            'itemSelecionado.required' => 'Você deve selecionar um item'
        ];
    }

    protected $listeners = ['abriuModal' => 'abriuModal', 'fechouModal' => 'fechouModal'];

    public function mount() 
    {
        $this->sistema = new DemandaSistema();
        $this->sistemas = DemandaSistema::all() ?? [];

        $this->sistemaSelecionado = null;
        $this->categoriaSelecionado = null;
        $this->subcategoriaSelecionado = null;
        $this->itemSelecionado = null;
    }

    public function abriuModal($id)
    {
        $this->checklistItem = ChecklistItemResposta::with('item')->findOrNew($id);
    }

    public function fechouModal()
    {
        $this->resetValidation();
        $this->sistema = new DemandaSistema();
        $this->sistemas = DemandaSistema::all() ?? [];

        $this->sistemaSelecionado = null;
        $this->categoriaSelecionado = null;
        $this->subcategoriaSelecionado = null;
        $this->itemSelecionado = null;
    }

    public function render()
    {
        return view('livewire.checklist.demanda-form');
    }

    public function updatedSistemaSelecionado($sistemaId)
    {
        $this->sistema = DemandaSistema::find($this->sistemaSelecionado);
    }

    public function salvar()
    {
        $this->validate();

        ChecklistItemDemanda::create([
            'sistema_id' => $this->sistemaSelecionado,
            'sistema_item_id' => $this->itemSelecionado,
            'checklist_item_resposta_id' => $this->checklistItem->id,
            'descricao' => $this->descricao,
        ]);

        $this->fechouModal();
        
        $this->dispatchBrowserEvent('triggerDemandaGravadaSucesso');
        $this->emit('atualizaProgressoChecklist');
    }
}
