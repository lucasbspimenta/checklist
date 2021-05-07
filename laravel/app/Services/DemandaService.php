<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Checklist;
use App\Models\ChecklistItemResposta;
use App\Models\ChecklistItemDemanda;
use App\Models\Agenda;

use App\Services\AtendimentoService;

class DemandaService 
{
    public static function processa(ChecklistItemDemanda $demanda) {
        echo $demanda->sistema->service_class_name . PHP_EOL;
        if($demanda->sistema->service_class_name && class_exists('App\\Services\\' . $demanda->sistema->service_class_name)){
            $class = new \ReflectionClass('App\\Services\\'.$demanda->sistema->service_class_name);
            $instance = $class->newInstanceArgs([$demanda]);
            return $instance->executar();
        }
        else
        {
            throw new \Exception("Sistema da demanda sem classe de tratamento registrada", 1);
        }
    }
}