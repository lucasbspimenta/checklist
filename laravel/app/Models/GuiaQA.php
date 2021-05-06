<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Auth;

class GuiaQA extends Model
{
    use HasFactory;

    protected $table = 'guia_q_a';

    protected $fillable = [
        'guia_id' 
		, 'pergunta'
        , 'resposta'
        , 'descricao'
        , 'situacao'
	];

    public function guia()
    {
        return $this->belongsTo(Guia::class);
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
