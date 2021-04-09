<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Agenda extends Model
{
    use HasFactory;

    protected $fillable = [
		'descricao'
        , 'inicio'
        , 'final'
        , 'imovel_id'
        , 'agendamento_tipos_id'
	];

    public function tipo()
    {
        return $this->belongsTo(Administracao\AgendamentoTipo::class, 'agendamento_tipos_id');
    }

    /*
    public function getInicioAttribute()
    {
        if (!$this->attributes['inicio']) {
            return '';
        }
        $date = new Carbon($this->attributes['inicio']);

        return $date->format('d/m/Y');
    }

    public function setInicioAttribute($value)
    {
        if ($value == '') {
            $this->attributes['inicio'] = NULL;
        } else {
            $date = Carbon::createFromFormat('d/m/Y', $value);
            $this->attributes['inicio'] = $date->format('Y-m-d');
        }
    }

    public function getFinalAttribute()
    {
        if (!$this->attributes['final']) {
            return '';
        }
        $date = new Carbon($this->attributes['final']);

        return $date->format('d/m/Y');
    }

    public function setFinalAttribute($value)
    {
        if ($value == '') {
            $this->attributes['final'] = NULL;
        } else {
            $date = Carbon::createFromFormat('d/m/Y', $value);
            $this->attributes['final'] = $date->format('Y-m-d');
        }
    }
    */
}
