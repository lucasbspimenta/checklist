<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Modal extends Component
{
    public $titulo;
    public $tamanho;

    public function __construct($titulo, $tamanho)
    {
        $this->titulo = $titulo;
        $this->tamanho = $tamanho;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modal');
    }
}
