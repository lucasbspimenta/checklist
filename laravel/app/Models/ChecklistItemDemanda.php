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
        return $this->belongsTo(ChecklistItemResposta::class,'checklist_item_resposta_id','id');
    }

    public function sistema()
    {
        return $this->belongsTo(DemandaSistema::class,'sistema_id','id');
    }

    public function getSistemaItemAttribute() {
        return $this->sistema->getItemById($this->sistema_item_id);
    }

    /**
     * Get the checklist.
     */
    public function checklist()
    {
        return $this->hasOne(Checklist::where('checklist.id', $this->resposta->checklist_id));

    }

    public function getResponsavelAttribute() {
        return User::find($this->updated_by);
    }

    /* 
    class Mechanic extends Model
    {
        //Get the car's owner.

        public function carOwner()
        {
            return $this->hasOneThrough(
                Owner::class,
                Car::class,
                'mechanic_id', // Foreign key on the cars table...
                'car_id', // Foreign key on the owners table...
                'id', // Local key on the mechanics table...
                'id' // Local key on the cars table...
            );
        }
    }
    */

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
