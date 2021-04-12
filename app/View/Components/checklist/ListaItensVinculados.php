<?php

namespace App\View\Components\checklist;

use Illuminate\View\Component;
use App\Models\Checklist;

class ListaItensVinculados extends Component
{
    
    public $checklist;

    public function __construct(Checklist $checklist)
    {
        $this->checklist = $checklist;
    }

    public function render()
    {
        return view('components.checklist.lista-itens-vinculados');
    }
}
