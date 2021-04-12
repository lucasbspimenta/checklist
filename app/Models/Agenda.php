<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

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

    public function checklist()
    {
        return $this->hasOne(Checklist::class)->withDefault();
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
}
