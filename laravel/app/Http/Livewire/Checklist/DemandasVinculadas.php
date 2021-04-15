<?php

namespace App\Http\Livewire\Checklist;

use Livewire\Component;

class DemandasVinculadas extends Component
{
    public $checklist;
    
    public function render()
    {
        return view('livewire.checklist.demandas-vinculadas');
    }
}
