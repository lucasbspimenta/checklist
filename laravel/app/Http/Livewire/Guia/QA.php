<?php

namespace App\Http\Livewire\Guia;

use Livewire\Component;

use App\Models\GuiaQA;

class QA extends Component
{
    public $qas = [];
    public $pergunta;
    public $resposta;

    public function rules() {
        return [
            'pergunta' => 'required',
            'resposta' => 'string'
        ];
    }

    public function messages() {
        return [
            'pergunta.required' => 'Pergunta é obrigatória',
        ];
    }

    public function render()
    {
        return view('livewire.guia.q-a');
    }

    public function mount() 
    {
        $this->pergunta = '';
        $this->resposta = '';
    }

    public function adicionaPergunta() {
        $this->validate();
        array_push($this->qas, array('pergunta' => $this->pergunta, 'resposta' => $this->resposta)); 
        $this->reset('pergunta','resposta');
    }

    public function removePergunta($index) {
        unset($this->qas[$index]);
    }

}
