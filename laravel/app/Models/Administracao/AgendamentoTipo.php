<?php

namespace App\Models\Administracao;

use Illuminate\Database\Eloquent\Model;

class AgendamentoTipo extends Model
{
    protected $fillable = ['nome','descricao', 'situacao', 'cor'];

    public function agendamentos()
    {
        return $this->hasMany(\App\Models\Agenda::class, 'agendamento_tipos_id', 'id');
    }
}
