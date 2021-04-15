<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'matricula',
        'fisica',
        'unidade',
        'funcao',
        'cargo'
    ];

    public function unidadeAdministrativa()
    {
        return $this->hasOne(Unidade::class,'codigo','unidade')->withDefault();
    }

    public function unidadeFisica()
    {
        return $this->hasOne(Unidade::class,'codigo','fisica')->withDefault();
    }
}
