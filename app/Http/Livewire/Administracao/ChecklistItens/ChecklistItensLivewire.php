<?php

namespace App\Http\Livewire\Administracao\ChecklistItens;

use Livewire\Component;
use App\Models\Administracao\ChecklistItem;

class ChecklistItensLivewire extends Component
{
    public $item_id;
    public $lista_itens = [];
    public $exibir_filhos = true;

    protected $listeners = ['atualizarListaItens' => 'carregaItens'];

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

    public function delete($id)
    {
        ChecklistItem::find($id)->delete();
        $this->carregaItens();
        $this->dispatchBrowserEvent('triggerMensagemSucesso','Item excluído com sucesso!');
    }
}
