<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

use App\Models\Unidade;
use App\Models\Checklist;
use App\Models\UserUnidades;

use Auth;

class UnidadeScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        switch ($model) {
            case $model instanceof Unidade:
                if(!Auth::user()->isGestor)
                    $builder->whereIn('codigo', UserUnidades::select('unidade_codigo')->where('matricula', Auth::user()->matricula));
                else
                    $builder->whereIn('codigo', DB::table('equipe_unidades')->select('unidade_codigo')->where('equipe_gestor', Auth::user()->matricula));
            break;

            case $model instanceof Checklist:
                if(!Auth::user()->isGestor)
                    $builder
                    ->join('agendas', 'checklists.agenda_id', '=', 'agendas.id')
                    ->whereIn('agendas.unidade_id', UserUnidades::select('unidade_codigo')->where('matricula', Auth::user()->matricula));
                else
                    $builder
                    ->join('agendas', 'checklists.agenda_id', '=', 'agendas.id')
                    ->whereIn('agendas.unidade_id', DB::table('equipe_unidades')->select('unidade_codigo')->where('equipe_gestor', Auth::user()->matricula));
            break;
            
            default:
                if(!Auth::user()->isGestor)
                    $builder->whereIn('unidade_id', UserUnidades::select('unidade_codigo')->where('matricula', Auth::user()->matricula));
                else
                    $builder->whereIn('unidade_id', DB::table('equipe_unidades')->select('unidade_codigo')->where('equipe_gestor', Auth::user()->matricula));
            break;
        } 
            
    }
}

?>
