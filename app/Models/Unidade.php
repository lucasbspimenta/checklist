<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\UnidadeScope;

class Unidade extends Model
{
    use HasFactory;

    protected $table = 'unidades';

    public function getNomeCompletoAttribute()
    {
        return ($this->tipoPv) ? $this->tipoPv . ' ' . $this->nome : $this->nome;
    }

    protected static function boot()
    {
        parent::boot();
 
        static::addGlobalScope(new UnidadeScope);
    }
}
