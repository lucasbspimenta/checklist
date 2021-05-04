<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Scopes\UnidadeScope;

use Auth;

class Agenda extends Model
{
    use HasFactory;

    protected $fillable = [
		'descricao'
        , 'inicio'
        , 'final'
        , 'unidade_id'
        , 'agendamento_tipos_id'
	];

    public function unidade()
    {
        return $this->belongsTo(Unidade::class)->withDefault();
    }

    public function tipo()
    {
        return $this->belongsTo(Administracao\AgendamentoTipo::class, 'agendamento_tipos_id');
    }

    public function checklist()
    {
        return $this->hasOne(Checklist::class)->withCount('demandas')->withDefault();
    }

    public function getInicioFormatadoAttribute() 
    {
        return ($this->inicio) ? Carbon::createFromFormat('Y-m-d', $this->inicio)->format('d/m/Y') : $this->inicio;
    }

    public function getFinalFormatadoAttribute() 
    {
        return ($this->final) ? Carbon::createFromFormat('Y-m-d', $this->final)->format('d/m/Y') : $this->final;
    }

    public function getDataFormatadaAttribute()
    {
        if($this->inicio && $this->final)
        {
            if($this->inicio == $this->final)
                return $this->inicioFormatado;
            else
                return $this->inicioFormatado . ' a ' .$this->finalFormatado;
        }
        else
        {
            return '';
        }
    }

    public function criarChecklist() 
    {
        DB::beginTransaction();
        
        $checklist = Checklist::create([
            'agenda_id' => $this->id,
            'concluido' => false
        ]);

        DB::commit();

        $this->refresh();
    }

    protected static function boot()
    {
        parent::boot();
 
        static::addGlobalScope(new UnidadeScope);

        static::creating(function ($model) {
            $model->created_by = Auth::id();
            $model->updated_by = Auth::id();
        });
        static::updating(function ($model) {
            $model->updated_by = Auth::id();
        });
        
    }
}
