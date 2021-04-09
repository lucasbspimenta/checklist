<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Administracao\AgendamentoTipo;
use Illuminate\Http\Request;

class AgendaController extends Controller
{

    public function index(Request $request)
    {
		//dd($request->ajax());
    	if($request->dataType == 'json')
    	{
    		$data = Agenda::where('agendamento_tipos_id', $request->tipo_id)
							->get(['id', 'descricao', 'inicio as start', 'final as end','imovel_id as title']);

            return response()->json($data);
    	}

		$lista_tipos_de_agendamento = AgendamentoTipo::where('situacao',1)->has('agendamentos')->get();

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
