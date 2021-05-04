<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Auth;

class ChecklistItemDemanda extends Model
{
    use HasFactory;

    protected $fillable = [
		    'sistema_id'
        ,   'sistema_item_id'
        ,   'checklist_item_resposta_id'
        ,   'descricao'
	];

    public function resposta()
    {
        return $this->hasOne(ChecklistItemResposta::class,'id','checklist_item_resposta_id');
    }

    public function sistema()
    {
        return $this->hasOne(DemandaSistema::class,'id','sistema_id');
    }

    public function getSistemaItemAttribute() {
        return $this->sistema->getItemById($this->sistema_item_id);
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
