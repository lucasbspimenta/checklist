<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

use App\Models\UserPerfil;

use Auth;

class User extends Authenticatable
{
    use Notifiable;

    protected $with = ['perfil'];


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
        return $this->hasOne(Unidade::class,'codigo','unidade')->withoutGlobalScope('App\Scopes\UnidadeScope')->withDefault();
    }

    public function unidadeFisica()
    {
        return $this->hasOne(Unidade::class,'codigo','fisica')->withoutGlobalScope('App\Scopes\UnidadeScope')->withDefault();
    }

    public function perfil()
    {
        return $this->hasOne(UserPerfil::class,'matricula','matricula');
    }

    public function getIsAdminAttribute() {

        $perfis_permitidos = array(env('PERFIL_GESTOR'), env('PERFIL_DESENVOLVEDOR'));
 
        if(in_array($this->perfil->perfil_codigo, $perfis_permitidos))
            return true;
        
        return false;
    }

    public function getIsRelogAttribute() {

        $perfis_permitidos = array(env('PERFIL_RELOG'), env('PERFIL_DESENVOLVEDOR'));
        
        if(in_array($this->perfil->perfil_codigo, $perfis_permitidos))
            return true;
        
        return false;
    }

    public function getIsGestorAttribute() {

        if (UserPerfil::where('equipe_gestor', $this->matricula)->exists())
           return true;
 
        return false;
    }
}
