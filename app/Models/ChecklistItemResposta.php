<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Administracao\ChecklistItem;

class ChecklistItemResposta extends Model
{
    use HasFactory;

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
}
