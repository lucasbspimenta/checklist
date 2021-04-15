<?php
// source: https://medium.com/@DarkGhostHunter/laravel-convert-to-json-all-responses-automatically-c4a72b2fd3ac

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use App\Models\User;
use Auth;
use App;
use Illuminate\Support\Facades\Log;

class AuthenticateLDAP
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (App::environment('local')) {
            $user = $this->getUserEnv();
        } else {
            $user = $this->getUser();
        }
        if ($user) {
            Auth::login($user);
            return $next($request);
        }
        return response('Não autorizado!', 403);
    }

    private function getUserEnv() {
        $matricula = env('AUTH_USER');
        $user = User::where('matricula', '=', $matricula)->first();
        return $user;
    }

    private function getUser()
    {
        $replaceDomains = ["CORPCAIXA\\", "corpcaixa\\", "CORPCAIXA/", "corpcaixa/"];
        $matricula='';
        if (isset($_SERVER["AUTH_USER"])) {
            $matricula = str_replace($replaceDomains, "", $_SERVER["AUTH_USER"]);
        } else {
            return false;
        }

        $ldapHandle = ldap_connect('ldap://ldapcluster.corecaixa:489');
        $searchBase = 'ou=People,o=caixa';
        $searchFilter = '(uid=%s)';

        $searchFilter = sprintf($searchFilter, $matricula);

        try {

            $searchHandle = ldap_search($ldapHandle, $searchBase, $searchFilter);

            if(!$searchHandle) {
                throw new Exception("Servidor de Autenticação Indisponível (LDAP: erro na consulta)");
            }

            $resultados = ldap_get_entries($ldapHandle, $searchHandle);

            $usuario = [];

            if($resultados['count'] == 1) {
                $resultado = $resultados[0];

                $nome = trim(strtoupper($resultado['no-usuario'][0]));
                $matricula   = trim(strtoupper($resultado['co-usuario'][0]));
                $fisica = intval($resultado['nu-lotacaofisica'][0]);
                $unidade = intval($resultado['co-unidade'][0]);
                $funcao = trim(strtoupper($resultado['no-funcao'][0]));
                $cargo = trim(strtoupper($resultado['no-cargo'][0]));
                $email = trim(strtoupper($resultado['mail'][0]));

                $user = User::where('matricula', '=', $matricula)->first();
                if (!$user) {
                    $user = User::create([
                        'name' => $nome,
                        'email' => $email,
                        'matricula' => $matricula,
                        'fisica' => $fisica,
                        'unidade' => $unidade,
                        'funcao' => $funcao,
                        'cargo' => $cargo,
                    ]);
                }
                return $user;
            }
        }
        catch (Exception $e) {
            return false;
        }
    }
}
