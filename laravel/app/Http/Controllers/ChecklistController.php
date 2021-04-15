<?php

namespace App\Http\Controllers;

use App\Models\Checklist;
use Illuminate\Http\Request;
use App\Models\Agenda;
use App\Models\Administracao\ChecklistItem;

use App\Services\ChecklistServices;

class ChecklistController extends Controller
{
    public function index()
    {
        $lista_checklists = Checklist::with(['respostas','itens','agendamento'])->get();
        $conta_itens_ativos = ChecklistItem::where('situacao','A')->count();
        $agendamentos_sem_checklist = Agenda::doesntHave('checklist')->count();

        return view('pages.checklist', compact('lista_checklists','conta_itens_ativos','agendamentos_sem_checklist'));
    }

    public function show(Request $request)
    {
        $agenda = $request->agenda_id != 'novo' ? Agenda::with('checklist')->find($request->agenda_id) : null;
        $agenda_sem_checklist = [];

        if(is_null($agenda) && $request->agenda_id != 'novo')
            return redirect()->route('checklist.index');
        
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

    public function delete(Request $request)
    {
        if($request->ajax())
        {
            if(Checklist::destroy($request->id))
                return response()->json(true);
            else
                throw new Exception("Erro ao excluir checklist", 1);
                
            
        }
    }
}
