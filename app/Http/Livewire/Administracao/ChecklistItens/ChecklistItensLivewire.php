<?php

namespace App\Http\Livewire\Administracao\ChecklistItens;

use Livewire\Component;
use App\Models\Administracao\ChecklistItem;

class ChecklistItensLivewire extends Component
{
    public $item_id;
    public $item;
    public $item_pai;
    public $lista_itens = [];
    public $exibir_filhos = true;

    public $exibirModal = false;

    public $isSubItem;
    public $isItemFilho;
    public $itemPaiID;

    public function rules() {
        return [
            'item.nome' => 'required|unique:checklist_items,nome'. !isset($this->item) ? '' : '.'. $this->item->id,
            'item.situacao' => 'boolean',
            'item.cor' => 'string',
            'item.ordem' => 'integer',
            'item.descricao' => 'string'
        ];
    }

    public function messages() {
        return [
            'item.nome.required' => 'Nome é obrigatório',
            'item.nome.unique' => 'Já existe esse nome cadastrado',
            'item.situacao.required' => 'Situação é obrigatório',
            'item.ordem.integer' => 'Deve um número inteiro'
        ];
    }

    public function render()
    {
        return view('livewire.administracao.checklist-itens.checklist-itens-livewire');
    }

    public function carregaItens() {
        $this->lista_itens = ChecklistItem::doesntHave('itempai')->orderBy('ordem','ASC')->get();
    }

    public function mount() {
        $this->carregaItens();
    }

    public function botaoCancelar()
    {
        $this->exibirModal = false;
    }

    public function salvar()
    {
        $this->validate();

        $this->item->itempai()->associate($this->item_pai);

        $this->item->save();

        $this->dispatchBrowserEvent('triggerMensagemSucesso','Item de Checklist gravado com sucesso!');

        $this->fechar();

        $this->carregaItens();
    }

    public function fechar() {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->exibirModal = false;
    }

    public function adicionarItem($isSubItem=false, $itemPaiID=false) {
        
        $this->item_pai = ChecklistItem::find($itemPaiID);
        $this->item = new ChecklistItem();

        $this->isSubItem = $isSubItem;

        $this->exibirModal = true;
    }

    public function delete($id)
    {
        ChecklistItem::find($id)->delete();
        $this->carregaItens();
        $this->dispatchBrowserEvent('triggerMensagemSucesso','Item excluído com sucesso!');
        $this->item = new ChecklistItem();
    }

    public function editar($itemId)
    {
        $this->exibirModal = true;
        $this->item = ChecklistItem::with('itempai')->find($itemId);

        if($this->item->checklist_items_id) { 
            $this->item_pai = ChecklistItem::find($this->item->checklist_items_id);
            $this->item->itempai()->associate($this->item_pai);
            $isSubItem = true;
        }
    }
}
