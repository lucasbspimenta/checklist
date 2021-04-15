<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Checklist;
use App\Models\ChecklistItemResposta;

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
}

?>