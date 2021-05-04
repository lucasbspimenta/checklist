<?php

namespace App\Http\Livewire\Checklist;

use Livewire\Component;

class BotaoFinalizar extends Component
{
    public $checklist;

    protected $listeners = ['atualizaProgressoChecklist' => 'atualizar'];

    public function render()
    {
        return view('livewire.checklist.botao-finalizar');
    }

    public function atualizar() {
        $this->checklist->fresh();
    }
}
