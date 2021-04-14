<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChecklistItemDemanda extends Model
{
    use HasFactory;

    protected $fillable = [
		    'sistema_id'
        ,   'checklist_item_resposta_id'
        ,   'descricao'
	];

    public static function boot() {
        parent::boot();

        /*
        static::creating(function ($model) {
            $model->created_by = Auth::id();
            $model->updated_by = Auth::id();
        });
        static::updating(function ($model) {
            $model->updated_by = Auth::id();
        });
        */
    }
}
