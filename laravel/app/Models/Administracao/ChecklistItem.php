<?php

namespace App\Models\Administracao;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\ChecklistItemResposta;
use App\Models\Guia;

use Auth;

class ChecklistItem extends Model
{
    use HasFactory;

    protected $fillable = ['nome','descricao', 'situacao', 'cor', 'item_pai_id', 'foto'];

    public function itensfilhos() {

        return $this->hasMany(ChecklistItem::class, 'item_pai_id')->with('itempai');
    }

    public function itempai()
    {
        return $this->belongsTo(ChecklistItem::class, 'item_pai_id');
    }

    public function guia() {

        return $this->hasOne(Guia::class, 'checklist_item_id');
    }

    public function concluidoNoChecklist($checklist_id) {
        $resposta = ChecklistItemResposta::where('checklist_id', $checklist_id)->where('checklist_item_id', $this->id)->first();
        return ($resposta) ? $resposta->concluido : 0;
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($item) { // before delete() method call this
            $item->itensfilhos()->delete();
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
