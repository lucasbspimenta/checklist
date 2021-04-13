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
}
