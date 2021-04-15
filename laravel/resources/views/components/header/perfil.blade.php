@auth
<div class="flex flex-shrink md:mt-0 mt-2 pl-2 relative group">
    <button type="button" class="text-gray-500 hover:text-gray-600 focus:outline-none focus:text-gray-600">
        <img class="w-6 h-6 rounded-full mx-auto" src="http://tedx.caixa/lib/asp/foto.asp?matricula={{ Auth::user()->matricula }}" alt="{{ Str::title(Auth::user()->name) }}">
    </button>
    <div class="absolute hidden z-30 bg-grey-100 group-hover:block md:-right-px max-w-sm md:min-w-sm">
        <div class="px-2 pt-2 pb-2 bg-white shadow mt-10 ">
            <div class="photo-wrapper">
                <img class="w-16 h-16 rounded-full mx-auto" src="http://tedx.caixa/lib/asp/foto.asp?matricula={{ Auth::user()->matricula }}" alt="{{ Str::title(Auth::user()->name) }}">
            </div>
            <div class="p-2">
                <h3 class="text-center text-base text-gray-900 font-medium leading-6">{{ Str::title(Auth::user()->name) }}</h3>
                <div class="text-center text-gray-400 text-sm font-semibold">
                    <p> - </p>
                </div>
                <table class="text-sm my-2">
                    <tbody><tr>
                        <td class="px-2 py-1 text-gray-500 font-semibold">Função</td>
                        <td class="px-2 py-1 md:whitespace-nowrap">{{ Str::title(Auth::user()->funcao) }}</td>
                    </tr>
                    <tr>
                        <td class="px-2 py-1 text-gray-500 font-semibold">Cargo</td>
                        <td class="px-2 py-1 md:whitespace-nowrap">{{ Str::title(Auth::user()->cargo) }}</td>
                    </tr>
                    <tr>
                        <td class="px-2 py-1 text-gray-500 font-semibold">Unidade Adm.</td>
                        <td class="px-2 py-1 md:whitespace-nowrap">{{ Auth::user()->unidadeAdministrativa->nomeCompleto }}</td>
                    </tr>
                    <tr>
                        <td class="px-2 py-1 text-gray-500 font-semibold">Unidade Física</td>
                        <td class="px-2 py-1 md:whitespace-nowrap">{{ Auth::user()->unidadeFisica->nomeCompleto }}</td>
                    </tr>
                </tbody></table>

                <div class="text-center my-2">
                    <a class="text-sm text-caixaAzul hover:underline hover:text-caixaAzul font-medium" href="#">Abrir perfil</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endauth
