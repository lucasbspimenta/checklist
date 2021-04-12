<div>
    <nav class="container h-auto px-2 mx-auto border-b">
        <nav class="my-2 text-xs text-gray-600 font-futura" aria-label="Breadcrumb">
            <ol class="inline-flex p-0 list-none">
                <li class="flex items-center">
                    <a href="#">Administração</a>
                    <svg class="w-2 h-2 mx-2 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
                </li>
                <li>Itens do Checklist</li>
            </ol>
        </nav>
        <div class="flex flex-row justify-between h-8 my-2">
            <div class="flex flex-shrink-0 mr-10">
                <h1 class="h-full text-lg text-caixaAzul font-futurabold"><span class="inline-block w-3 h-3 mr-2 bg-caixaLaranja" style="clip-path: polygon(100% 0, 0 100%, 100% 100%);"></span>Itens do Checklist</h1>
            </div>
            @if (session()->has('message'))
                <div id="alert" class="inline-block px-6 py-1 text-sm text-white bg-green-500 border-0 rounded">
                    <span class="inline-block h-full mr-8 text-center align-middle">
                        {{ session('message') }}
                    </span>
                    <button class="mt-1 mr-1 text-lg font-semibold leading-none bg-transparent outline-none focus:outline-none" onclick="document.getElementById('alert').remove();">
                        <span>×</span>
                    </button>
                </div>
            @endif
            <div class="flex items-center">
                <label class="inline-flex items-center px-3 mr-4 text-sm border h-3/4 " wire:loading.attr="disabled">
                    <input
                        wire:loading.attr="disabled"
                      type="checkbox"
                      class="border-2 border-gray-300 outline-none text-caixaLaranja focus:border-caixaLaranja focus:outline-none"
                      wire:model="exibir_filhos"
                    />
                    <span class="ml-2">Exibir subitens</span>
                  </label>
                <button onClick="abrirModalChecklist(false)" wire:loading.attr="disabled" class="px-3 font-sans text-sm text-white border border-solid border-caixaLaranja bg-caixaLaranja bg-opacity-90 h-3/4 hover:bg-opacity-100 focus:outline-none" ><i class="fas fa-plus md:mr-2"></i><div class="hidden md:inline-block">Adicionar</div></button>
            </div>
        </div>
    </nav>
    <div class="container h-auto px-2 py-3 mx-auto">
        <div class="relative overflow-x-auto overflow-y-auto bg-white shadow">
            <table id="table_itens_checklist" class="relative w-full whitespace-no-wrap bg-white border-collapse table-auto table-striped">
                <thead>
                    <tr>
                        <th class="px-2 py-2 mb-2 text-sm leading-4 tracking-wider text-left text-blue-500 border-b-2 border-gray-300">Nome</th>
                        <th class="px-2 py-2 text-sm leading-4 tracking-wider text-left text-blue-500 border-b-2 border-gray-300">Descrição</th>
                        <th class="px-2 py-2 text-sm leading-4 tracking-wider text-left text-blue-500 border-b-2 border-gray-300">Foto</th>
                        <th class="px-2 py-2 text-sm leading-4 tracking-wider text-left text-blue-500 border-b-2 border-gray-300">Subitens</th>
                        <th class="px-2 py-2 text-sm leading-4 tracking-wider text-left text-blue-500 border-b-2 border-gray-300">Situação</th>
                        <th class="px-2 py-2 text-sm leading-4 tracking-wider text-left text-blue-500 border-b-2 border-gray-300">Opções</th>
                    </tr>
                </thead>
                <tbody class="mt-2 text-sm">
                    @foreach($lista_itens as $item)
                        <tr class="border-b" x-init="() => { exibirLinhasFilhas{{ $item->id }}: false }">
                            <td class="px-2 py-2 whitespace-no-wrap border-0 border-l-8" style="border-color: {{ $item->cor }}">
                                <b>{{ $item->nome }}</b>
                                @if($item->itensFilhos->count() > 0)
                                    <button onClick="$('.exibirLinhasFilhas{{ $item->id }}').toggleClass('hidden');" @click="exibirLinhasFilhas{{ $item->id }} = !exibirLinhasFilhas{{ $item->id }}" class="h-full px-3 font-sans text-sm text-caixaAzul focus:outline-none" >
                                        <i class="fas fa-chevron-down md:mr-2" x-bind:class="{ 'hidden': !exibirLinhasFilhas{{ $item->id }} }" x-show="!exibirLinhasFilhas{{ $item->id }}"></i>
                                        <i class="hidden fas fa-chevron-up md:mr-2" x-bind:class="{ 'hidden': exibirLinhasFilhas{{ $item->id }} }" x-show="exibirLinhasFilhas{{ $item->id }}"></i>
                                    </button>
                                @endif
                            </td>
                            <td class="px-2 py-2">{{ $item->descricao }}</td>
                            <td class="w-1/5 px-2 py-2">{!! ($item->foto == 'S') ? '<div class="text-sm leading-none text-green-600">Sim</div>' : '' !!}</td>
                            <td class="w-1/5 px-2 py-2">
                                <div class="flex justify-start flex-nowrap">
                                    <span class="items-center table-cell p-1 mr-2 text-sm leading-none text-white bg-blue-400 rounded">
                                        {{ $item->itensFilhos->count() }}
                                    </span>
                                    <button onClick="abrirModalChecklist({{ $item->id }}, true)" wire:loading.attr="disabled" class="h-full px-3 font-sans text-sm border text-caixaAzul focus:outline-none" ><i class="fas fa-plus md:mr-1"></i><div class="hidden md:inline-block">Adicionar Subitem</div></button>
                                </div>
                            </td>
                            <td class="w-1/5 px-2 py-2">
                                @if ($item->situacao == 'A')
                                    <span class="items-center table-cell p-1 text-sm leading-none text-white bg-green-600 rounded">
                                        Ativado
                                    </span>
                                @else
                                    <span class="items-center table-cell p-1 text-sm leading-none text-white bg-red-600 rounded">
                                        Desativado
                                    </span>
                                @endif
                            </td>
                            <td class="w-1/5 px-2 py-2">
                                <div class="flex flex-nowrap">
                                    <button 
                                        onClick="abrirModalChecklist({{ $item->id }})"
                                        wire:loading.attr="disabled"
                                        class="px-3 font-sans text-sm bg-white border border-white border-solid text-caixaAzul hover:border-gray focus:outline-none" >
                                        <i class="fas fa-edit"></i>
                                </button>
                                    <button 
                                        wire:click="$emit('triggerDelete',[{{ $item->id }},'O item e seus subitens serão excluídos'])"
                                        wire:loading.attr="disabled"
                                        class="px-3 font-sans text-sm bg-white border border-white border-solid text-red hover:border-gray focus:outline-none" >
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @foreach($item->itensFilhos->sortBy('ordem') as $item_filho)
                            <tr class="border-b @if(!$exibir_filhos) hidden @endif exibirLinhasFilhas{{ $item->id }}">
                                <td class="px-2 py-2 whitespace-no-wrap border-0 border-l-8" style="border-color: {{ $item->cor }}">
                                    <div class="w-full px-2 border-0 border-l-4" style="border-color: {{ $item->cor }}">
                                        {{ $item_filho->nome }}
                                    </div>
                                </td>
                                <td class="px-2 py-2">{{ $item_filho->descricao }}</td>
                                <td class="w-1/5 px-2 py-2">{!! ($item_filho->foto == 'S') ? '<span class="text-sm leading-none text-green-600">Sim</span>' : '' !!}</td>
                                <td class="px-2 py-2">-</td>
                                <td class="w-1/5 px-2 py-2">
                                    @if ($item_filho->situacao == 'A')
                                        <span class="items-center table-cell p-1 text-sm leading-none text-white bg-green-600 rounded">
                                            Ativado
                                        </span>
                                    @else
                                        <span class="items-center table-cell p-1 text-sm leading-none text-white bg-red-600 rounded">
                                            Desativado
                                        </span>
                                    @endif
                                </td>
                                <td class="w-1/5 px-2 py-2">
                                    <div class="flex flex-nowrap">
                                        <button 
                                            onClick="abrirModalChecklist({{ $item_filho->id }})"
                                            wire:loading.attr="disabled"
                                            class="px-3 font-sans text-sm bg-white border border-white border-solid text-caixaAzul hover:border-gray focus:outline-none" >
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button 
                                            wire:click="$emit('triggerDelete',[{{ $item_filho->id }},'O item será excluído'])"
                                            wire:loading.attr="disabled"
                                            class="px-3 font-sans text-sm bg-white border border-white border-solid text-red hover:border-gray focus:outline-none" >
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <livewire:administracao.checklist-itens.modal-checklist-livewire/>
</div>
@push('scripts')
    <script>

    function abrirModalChecklist(id, subitem=false) {
        Livewire.emit('abrirModalChecklist',id, subitem);
    }

    window.addEventListener('triggerChecklistItemGravadoSucesso', event => {
        toastr.success(event.detail);
        Livewire.emit('atualizarListaItens');
    });
        
    Livewire.on('triggerDelete', ([itemId, mensagem]) => {
        
        Swal.fire({
                title: 'Você tem certeza?',
                text: mensagem,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sim, tenho certeza!',
                cancelButtonText: 'Não'
            }).then((result) => {
                if (result.value) {
                    @this.call('delete',itemId)
                } else {
                    console.log("Canceled");
                }
            });
    })
        
    </script>
@endpush

