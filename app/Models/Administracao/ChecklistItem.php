<?php

namespace App\Models\Administracao;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChecklistItem extends Model
{
    use HasFactory;

    protected $fillable = ['nome','descricao', 'situacao', 'cor', 'checklist_items_id'];

    public function itensfilhos() {

        return $this->hasMany(ChecklistItem::class, 'checklist_items_id')->with('itensfilhos');
    }

    public function itempai()
    {
        return $this->belongsTo(ChecklistItem::class, 'checklist_items_id');
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($item) { // before delete() method call this
            $item->itensfilhos()->delete();
        });
    }
}
