<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Unidade;
use App\Models\Agenda;
use App\Models\Administracao\AgendamentoTipo;

class AgendaController extends Controller
{

    public function index(Request $request)
    {
		//dd($request->ajax());
    	if($request->dataType == 'json')
    	{
    		$data = Agenda::join('unidades', 'agendas.unidade_id', '=', 'unidades.id')->where('agendamento_tipos_id', $request->tipo_id)
							->get(['agendas.id', 'descricao', 'inicio as start', 'final as end',DB::raw("unidades.tipoPv + ' ' + unidades.nome as title")]);

            return response()->json($data);
    	}

		$lista_tipos_de_agendamento = AgendamentoTipo::where('situacao',1)->get();

    	return view('pages.agenda', compact('lista_tipos_de_agendamento'));
    }

	public function store(Request $request) {

		$agenda = Agenda::find($request->id)->update([
			'inicio' =>	$request->inicio,
			'final'	 =>	$request->final ?? $request->inicio
		]);

		return response()->json($agenda);
	}
}
