<a class="flex row items-start border-l-2 md:border-l-0 md:border-b-4 border-transparent font-futura  bg-transparent p-2 hover:text-caixaAzul 
focus:text-caixaAzul hover:border-caixaAzul hover:bg-gray-50 focus:outline-none focus:border-caixaAzul
{{ request()->routeIs($nomerota) ? 'border-caixaLaranja text-caixaLaranja' : '' }}
" href="{{ route($nomerota) }}">
    <div class="p-2">
        <i class="fas fa-{{$icone}} mr-2"></i>
    </div>
    <div class="ml-1">
        <p class="font-futura text-base">{{$nome}}</p>
        <p class="text-xs">{{$descricao}}</p>
    </div>
</a>
