<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Models\Administracao\ChecklistItem;

use Auth;

class Checklist extends Model
{
    use HasFactory;

    protected $with = ['respostas'];

    protected $fillable = [
		'agenda_id'
        , 'concluido'
	];

    public function agendamento()
    {
        return $this->belongsTo(Agenda::class, 'agenda_id')->withDefault();
    }

    public function getPercentualPreenchimentoAttribute() 
    {
        $total_itens = $this->respostas->count();
        $concluidos  = $this->respostas->where('concluido', 1)->count();

        $percentual = ($total_itens > 0) ? ($concluidos * 100) / $total_itens : 0;

        return round($percentual,2,PHP_ROUND_HALF_ODD);
    }

    public function getpercentualDemandasAttribute() 
    {
        return 0.00;
    }

    public function getMacroitensAttribute()
    {
        return ChecklistItem::whereIn('id', $this->ids_itens_pais())->get();

        //return ChecklistItemResposta::whereIn('checklist_item_id', $this->ids_itens_pais())->get();
    }

    public function getFotosObrigatoriasAttribute() 
    {
        return $this->respostas()->whereRaw("[checklist_items].[foto] = 'S'")->get();
    }

    public function ids_itens_pais() {
        return ChecklistItemResposta::join(app(ChecklistItem::class)->getTable(), app(ChecklistItemResposta::class)->getTable().'.checklist_item_id', '=', app(ChecklistItem::class)->getTable() . '.id')
                                ->select('item_pai_id')
                                ->distinct()
                                ->get()
                                ->toArray();
    }

    
    public function respostas() 
    {
        return $this->hasMany(ChecklistItemResposta::class)
                ->leftJoin(app(ChecklistItem::class)->getTable(), app(ChecklistItemResposta::class)->getTable().'.checklist_item_id', '=', app(ChecklistItem::class)->getTable() . '.id')
                ->select(app(ChecklistItemResposta::class)->getTable().'.*', 'item_pai_id')->withCount('demandas');
    }
    

    public function itens()
    {
        //return $this->hasManyThrough(ChecklistItem::class, ChecklistItemResposta::class);

        return $this->hasManyThrough(
            ChecklistItem::class,
            ChecklistItemResposta::class,
            'checklist_id', // Foreign key on the environments table...
            'id', // Foreign key on the deployments table...
            'id', // Local key on the projects table...
            'checklist_item_id' // Local key on the environments table...
        )->with('itempai');
    }

    public function demandas()
    {
 
        return $this->hasManyThrough(
            ChecklistItemDemanda::class,
            ChecklistItemResposta::class,
            'checklist_id', // Foreign key on the environments table...
            'checklist_item_resposta_id', // Foreign key on the deployments table...
            'id', // Local key on the projects table...
            'id' // Local key on the environments table...
        )->with('resposta');

        
    }

    protected static function booted()
    {
        static::created(function ($checklist) 
        {
            $itens_ativos = ChecklistItem::select( DB::raw('id as checklist_item_id'),
            DB::raw($checklist->id . ' as checklist_id'),
            DB::raw('NULL as resposta'))
            ->where('situacao', 'A')
            ->Where(function($query) {
                $query->whereNotNull('item_pai_id')
                      ->orWhere('foto', 'S');
            })
            ->orderBy('ordem')
            ->get()->toArray();

            $checklist->respostas()->createMany($itens_ativos);
            $checklist->refresh();
        });
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($checklist) {
            $checklist->respostas()->delete();
        });

        
        static::creating(function ($model) {
            $model->created_by = Auth::id();
            $model->updated_by = Auth::id();
        });
        static::updating(function ($model) {
            $model->updated_by = Auth::id();
        });
        
    }

}

