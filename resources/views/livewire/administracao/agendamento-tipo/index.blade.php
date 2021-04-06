<nav class="container mx-auto h-auto px-2 border-b">
    <nav class="text-gray-600 font-futura text-xs my-2" aria-label="Breadcrumb">
        <ol class="list-none p-0 inline-flex">
            <li class="flex items-center">
                <a href="#">Administração</a>
                <svg class="fill-current w-2 h-2 mx-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
            </li>
            <li>Tipos de Agendamento</li>
        </ol>
    </nav>
    <div class="flex flex-row justify-between my-2 h-8">
        <div class="flex flex-shrink-0 mr-10">
            <h1 class="text-caixaAzul font-futurabold text-lg h-full"><span class="w-4 h-4 bg-caixaLaranja inline-block mr-2" style="clip-path: polygon(100% 0, 0 100%, 100% 100%);"></span>Tipos de Agendamento</h1>
        </div>
        <div class="flex">
            <button class="border-solid border border-caixaLaranja text-sm font-sans bg-caixaLaranja bg-opacity-90 text-white h-3/4 px-3 hover:bg-opacity-100 focus:outline-none" ><i class="fas fa-plus md:mr-2"></i><div class="hidden md:inline-block">Adicionar</div></button>
        </div>
    </div>
</nav>
<div class="container mx-auto h-auto py-3 px-2">
    <livewire:administracao.agendamento-tipo.datatable searchable="nome, descricao, situacao" exportable />
</div>