<?php

namespace App\Http\Controllers;

use App\Models\Checklist;
use Illuminate\Http\Request;
use App\Models\Agenda;

use App\Services\ChecklistServices;

class ChecklistController extends Controller
{
    public function index()
    {
        return view('pages.checklist');
    }

    public function show(Request $request)
    {
        $agenda = $request->agenda_id != 'novo' ? Agenda::with('checklist')->find($request->agenda_id) : null;
        $agenda_sem_checklist = [];
        
        switch ($request->method()) {

            case 'POST':

                ChecklistServices::registrarItens($request);
                $agenda->checklist->fresh('respostas');
                $agenda->refresh();

            break;
    
            case 'GET':
                $agenda_sem_checklist = Agenda::doesntHave('checklist')->get();

                if($agenda && !$agenda->checklist->exists)
                    $agenda->criarChecklist();

            break;
        }

        return view('pages.checklist-form', compact('agenda','agenda_sem_checklist'));
    }
}
