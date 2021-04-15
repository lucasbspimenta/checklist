<?php

namespace App\View\Components\checklist;

use Illuminate\View\Component;
use App\Models\Checklist;

class FotosObrigatorias extends Component
{
    public $checklist;

    public function __construct(Checklist $checklist)
    {
        $this->checklist = $checklist;
    }

    public function render()
    {
        return view('components.checklist.fotos-obrigatorias');
    }
}
