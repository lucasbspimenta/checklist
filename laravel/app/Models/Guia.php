<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Administracao\ChecklistItem;

use Auth;

class Guia extends Model
{
    use HasFactory;

    protected $table = 'guia';

    protected $fillable = [
		'checklist_item_id'
        , 'descricao'
	];

    public function imagens()
    {
        return $this->morphMany(Imagem::class, 'imageable');
    }

    public function item()
    {
        return $this->belongsTo(ChecklistItem::class, 'checklist_item_id');
    }

    public function QAs()
    {
        return $this->hasMany(GuiaQA::class);
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($guia) {
            $guia->imagens()->delete();
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
