<div >
    @forelse ($checklist->demandas as $demanda)
        <div class="w-full mb-4 border border-gray-200 rounded-t hover:bg-gray-100">
            <div class="relative flex items-center w-full p-2 pl-2 border-l-4 border-caixaLaranja">
                <div class="flex w-full">
                    <div class="w-auto mx-2 -mt-1 text-sm text-gray-700 ">
                        <div class="flex items-center justify-between w-full">
                            {{ $demanda->resposta->item->itemPai->nome  }}&nbsp;&#10148;&nbsp;{{ $demanda->resposta->item->nome  }}
                            @if(trim($demanda->migracao) == 'P' && $checklist->concluido != 1)
                            <div class="flex-initial max-w-full text-xs font-normal leading-none text-red-600 cursor-pointer whitespace-nowrap" alt="Excluir demanda">
                                <button class="outline-none focus:outline-none" onClick="ConfirmaExclusaoDemanda({{ $demanda->id }})"><i class="mx-2 font-bold text-red-600 fas fa-trash"></i></button>
                            </div>
                            @endif
                        </div>
                        <div class="w-full mt-1 text-xs font-normal text-gray-500 normal-case truncate">{{ $demanda->sistema->nome }}</div>
                        <div class="w-full mt-1 text-xs font-normal text-gray-500 normal-case truncate">{{ ($demanda->sistemaItem) ? $demanda->sistemaItem->nome : '' }}</div>
                   
                        <div class="flex justify-between w-full">
                            @if(trim($demanda->migracao) == 'P')
                                <div class="flex items-center justify-center px-2 py-1 m-1 font-medium text-gray-600 border border-gray-300 bg-gray-50 ">
                                    <div class="flex-initial max-w-full text-xs font-normal leading-none whitespace-nowrap">A processar</div>
                                </div>
                            @endif
                            @if(trim($demanda->migracao) == 'C')
                                <div class="flex items-center justify-center px-2 py-1 m-1 font-medium text-gray-600 bg-green-100 border border-gray-300">
                                    <div class="flex-initial max-w-full text-xs font-normal leading-none whitespace-nowrap">Processado</div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        
    @endforelse
</div>
