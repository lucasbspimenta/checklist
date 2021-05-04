<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Models\Administracao\ChecklistItem;

use Auth;

class ChecklistItemResposta extends Model
{
    use HasFactory;

    protected $withCount = ['demandas'];

    protected $fillable = [
		'checklist_item_id'
        , 'checklist_id'
        , 'resposta'
	];

    public function checklist()
    {
        return $this->belongsTo(Checklist::class);
    }

    public function item()
    {
        return $this->hasOne(ChecklistItem::class,'id','checklist_item_id');
    }

    public function demandas()
    {
        return $this->hasMany(ChecklistItemDemanda::class,'checklist_item_resposta_id','id');
    }

    public function getRespostaAttribute($value) {

        if($value != -1 && $this->demandas_count > 0)
            return -1;

        return $this->value;
    }

    public function getConcluidoAttribute() {

        $retorno = DB::select("SELECT 
                                    cir.id,
                                    cir.checklist_id,
                                    concluido = CASE
                                                    WHEN ci.item_pai_id IS NOT NULL AND ci.foto = 'N' AND cir.resposta IS NOT NULL AND cir.resposta <> -1 THEN 1
                                                    WHEN ci.item_pai_id IS NOT NULL AND ci.foto = 'N' AND cir.resposta IS NOT NULL AND cir.resposta = -1 AND total_demandas > 0 THEN 1
                                                    WHEN ci.item_pai_id IS NOT NULL AND ci.foto = 'S' AND cir.resposta IS NOT NULL AND cir.resposta <> -1 AND cir.foto IS NOT NULL  THEN 1
                                                    WHEN ci.item_pai_id IS NOT NULL AND ci.foto = 'S' AND cir.resposta IS NOT NULL AND cir.resposta = -1 AND cir.foto IS NOT NULL AND total_demandas > 0 THEN 1
                                                    WHEN ci.item_pai_id IS NULL AND ci.foto = 'S' AND cir.foto IS NOT NULL THEN 1
                                                    ELSE 0
                                                END
                                FROM [checklist_item_respostas] cir
                                INNER JOIN [checklist_items] ci ON cir.checklist_item_id = ci.id
                                CROSS APPLY (SELECT COUNT(*) as total_demandas FROM [checklist_item_demandas]) as total_demandas
                                WHERE cir.id = ?", [$this->id]);
        return $retorno[0]->concluido ?? null;
    }

    public static function boot() {
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
