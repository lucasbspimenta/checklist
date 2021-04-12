<?php

namespace App\Http\Livewire\Administracao\ChecklistItens;

use Livewire\Component;
use App\Models\Administracao\ChecklistItem;

class ModalChecklistLivewire extends Component
{
    public $checklistitem;
    
    public $exibirModal = false;

    protected $listeners = ['abrirModalChecklist' => 'abrirModal'];

    public function render()
    {
        return view('livewire.administracao.checklist-itens.modal-checklist-livewire');
    }

    public function getItempaiProperty()
    {
        return ChecklistItem::findOrNew($this->checklistitem->item_pai_id);
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function rules() {
        return [
            'checklistitem.nome' => 'required|unique:checklist_items,nome,'.$this->checklistitem->id,
            'checklistitem.situacao' => 'required|in:A,D',
            'checklistitem.cor' => 'string',
            'checklistitem.ordem' => 'integer',
            'checklistitem.descricao' => 'string',
            'checklistitem.foto' => 'required|in:S,N',
            'checklistitem.item_pai_id' => 'integer',
        ];
    }

    public function messages() {
        return [
            'checklistitem.nome.required' => 'Nome é obrigatório',
            'checklistitem.nome.unique' => 'Já existe esse nome cadastrado',
            'checklistitem.situacao.required' => 'Situação é obrigatório',
            'checklistitem.foto.required' => 'Foto é obrigatória',
            'checklistitem.ordem.integer' => 'Deve um número inteiro'
        ];
    }

    public function mount(ChecklistItem $checklistitem) 
    {
        $this->checklistitem = $checklistitem ?? new ChecklistItem();
    }

    public function abrirModal($id=null, $is_subitem=false) 
    {
        $this->resetValidation();
        $this->exibirModal = true;
        $this->checklistitem = ChecklistItem::findOrNew($id);

        if($is_subitem) {
            $this->checklistitem = new ChecklistItem();
            $this->checklistitem->item_pai_id = $id;
        }
    }

    public function botaoCancelar()
    {
        $this->checklistitem = new ChecklistItem();
        $this->exibirModal = false;
    }

    public function salvar()
    {
        $this->validate();
        $this->checklistitem->save();

        $this->dispatchBrowserEvent('triggerChecklistItemGravadoSucesso', 'Item: ' . $this->checklistitem->nome . ' gravado com sucesso!');
        $this->botaoCancelar();

        $this->reset();
        $this->checklistitem = new ChecklistItem();
    }
}
