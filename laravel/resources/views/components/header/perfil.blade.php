@auth
<div class="relative flex flex-shrink pl-2 mt-2 md:mt-0 group">
    <button type="button" class="text-gray-500 hover:text-gray-600 focus:outline-none focus:text-gray-600">
        <img class="w-6 h-6 mx-auto rounded-full" src="http://tedx.caixa/lib/asp/foto.asp?matricula={{ Auth::user()->matricula }}" alt="{{ Str::title(Auth::user()->name) }}" onerror="this.onerror=null; this.src='{{ asset('images/semfoto.png') }}'">
    </button>
    <div class="absolute z-30 hidden max-w-sm bg-grey-100 group-hover:block md:-right-px md:min-w-sm">
        <div class="px-2 pt-2 pb-2 mt-10 bg-white shadow ">
            <div class="photo-wrapper">
                <img class="w-16 h-16 mx-auto rounded-full" src="http://tedx.caixa/lib/asp/foto.asp?matricula={{ Auth::user()->matricula }}" alt="{{ Str::title(Auth::user()->name) }}" onerror="this.onerror=null; this.src='{{ asset('images/semfoto.png') }}'">
            </div>
            <div class="p-2">
                <h3 class="text-base font-medium leading-6 text-center text-gray-900">{{ Str::title(Auth::user()->name) }}</h3>
                <div class="text-sm font-semibold text-center text-gray-400">
                    <p> - </p>
                </div>
                <table class="my-2 text-sm">
                    <tbody><tr>
                        <td class="px-2 py-1 font-semibold text-gray-500">Função</td>
                        <td class="px-2 py-1 md:whitespace-nowrap">{{ Str::title(Auth::user()->funcao) }}</td>
                    </tr>
                    <tr>
                        <td class="px-2 py-1 font-semibold text-gray-500">Cargo</td>
                        <td class="px-2 py-1 md:whitespace-nowrap">{{ Str::title(Auth::user()->cargo) }}</td>
                    </tr>
                    <tr>
                        <td class="px-2 py-1 font-semibold text-gray-500">Unidade Adm.</td>
                        <td class="px-2 py-1 md:whitespace-nowrap">{{ Auth::user()->unidadeAdministrativa->nomeCompleto }}</td>
                    </tr>
                    <tr>
                        <td class="px-2 py-1 font-semibold text-gray-500">Unidade Física</td>
                        <td class="px-2 py-1 md:whitespace-nowrap">{{ Auth::user()->unidadeFisica->nomeCompleto }}</td>
                    </tr>
                </tbody></table>

                <div class="my-2 text-center">
                    <a class="text-sm font-medium text-caixaAzul hover:underline hover:text-caixaAzul" href="#">Abrir perfil</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endauth
