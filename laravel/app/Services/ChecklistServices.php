<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Checklist;
use App\Models\ChecklistItemResposta;
use App\Models\ChecklistItemDemanda;
use App\Models\Agenda;
use App\Services\DemandaService;

class ChecklistServices 
{   
    public static function registrarItens(Request $request) 
    {
        $invertido = array();

        foreach($request->resposta as $id => $valor) {
            $invertido[$valor][] = $id;
        }
        
        foreach($invertido as $valor => $ids) {
            $affected_rows = ChecklistItemResposta::whereIn('id', $ids)->update(['resposta' => $valor]);
        }

        $request->session()->flash('mensagem_sucesso', 'Checklist gravado com sucesso!');
    }

    public static function finalizar(Request $request) 
    {
        $agenda = Agenda::with('checklist')->findOrFail($request->agenda_id);

        if($agenda->checklist->percentualPreenchimento >= 100)
        {
            $agenda->checklist->concluido = 1;
            $agenda->checklist->save();

            if(env('MIGRAR_DEMANDAS') && env('MIGRAR_DEMANDAS') == 1)
                ChecklistServices::processaDemandas($agenda->checklist);

            $request->session()->flash('mensagem_sucesso', 'Checklist finalizado com sucesso!');
        }
        else
        {
            $request->session()->error('mensagem_error', 'Não foi possivel finalizar o checklist');
        }

        
    }

    public static function processaDemandas(Checklist $checklist) {
        if($checklist->concluido && $checklist->demandas && sizeof($checklist->demandas) > 1) {

            $checklist->demandas->map(function($demanda) { DemandaService::processa($demanda); });
            
        } else {
            throw new \Exception("O checklist deve estar concluído para processar as demandas.", 1);
            
        }
    }
}

?>