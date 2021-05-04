<?php

namespace App\Models\Administracao;

use Illuminate\Database\Eloquent\Model;

use Auth;

class AgendamentoTipo extends Model
{
    protected $fillable = ['nome','descricao', 'situacao', 'cor'];

    public function agendamentos()
    {
        return $this->hasMany(\App\Models\Agenda::class, 'agendamento_tipos_id', 'id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_by = Auth::id();
            $model->updated_by = Auth::id();
        });
        static::updating(function ($model) {
            $model->updated_by = Auth::id();
        });
        
    }
}
