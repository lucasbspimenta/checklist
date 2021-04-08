<div>
    <nav class="container mx-auto h-auto px-2 border-b">
        <nav class="text-gray-600 font-futura text-xs my-2" aria-label="Breadcrumb">
            <ol class="list-none p-0 inline-flex">
                <li class="flex items-center">
                    <a href="#">Administração</a>
                    <svg class="fill-current w-2 h-2 mx-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
                </li>
                <li>Itens do Checklist</li>
            </ol>
        </nav>
        <div class="flex flex-row justify-between my-2 h-8">
            <div class="flex flex-shrink-0 mr-10">
                <h1 class="text-caixaAzul font-futurabold text-lg h-full"><span class="w-3 h-3 bg-caixaLaranja inline-block mr-2" style="clip-path: polygon(100% 0, 0 100%, 100% 100%);"></span>Itens do Checklist</h1>
            </div>
            @if (session()->has('message'))
                <div id="alert" class="text-white px-6 py-1 border-0 rounded inline-block bg-green-500 text-sm">
                    <span class="inline-block align-middle mr-8 h-full text-center">
                        {{ session('message') }}
                    </span>
                    <button class="bg-transparent text-lg font-semibold leading-none mt-1 mr-1 outline-none focus:outline-none" onclick="document.getElementById('alert').remove();">
                        <span>×</span>
                    </button>
                </div>
            @endif
            <div class="flex items-center">
                <label class="inline-flex items-center mr-4 text-sm border h-3/4 px-3 " wire:loading.attr="disabled">
                    <input
                        wire:loading.attr="disabled"
                      type="checkbox"
                      class="border-gray-300 border-2 text-caixaLaranja focus:border-caixaLaranja outline-none focus:outline-none"
                      wire:model="exibir_filhos"
                    />
                    <span class="ml-2">Exibir subitens</span>
                  </label>
                <button wire:click="adicionarItem" wire:loading.attr="disabled" class="border-solid border border-caixaLaranja text-sm font-sans bg-caixaLaranja bg-opacity-90 text-white h-3/4 px-3 hover:bg-opacity-100 focus:outline-none" ><i class="fas fa-plus md:mr-2"></i><div class="hidden md:inline-block">Adicionar</div></button>
            </div>
        </div>
    </nav>
    <div class="container mx-auto h-auto py-3 px-2">
        <div class="overflow-x-auto bg-white shadow overflow-y-auto relative">
            <table id="table_itens_checklist" class="w-full border-collapse table-auto whitespace-no-wrap table-striped relative bg-white">
                <thead>
                    <tr>
                        <th class="px-2 py-2 mb-2 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">Nome</th>
                        <th class="px-2 py-2 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">Descrição</th>
                        <th class="px-2 py-2 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">Subitens</th>
                        <th class="px-2 py-2 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">Situação</th>
                        <th class="px-2 py-2 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">Opções</th>
                    </tr>
                </thead>
                <tbody class="mt-2 text-sm">
                    @foreach($lista_itens as $item)
                        <tr class="border-b" x-init="() => { exibirLinhasFilhas{{ $item->id }}: false }">
                            <td class="border-l-8 border-0 px-2 py-2 whitespace-no-wrap" style="border-color: {{ $item->cor }}">
                                <b>{{ $item->nome }}</b>
                                @if($item->itensFilhos->count() > 0)
                                    <button onClick="$('.exibirLinhasFilhas{{ $item->id }}').toggleClass('hidden');" @click="exibirLinhasFilhas{{ $item->id }} = !exibirLinhasFilhas{{ $item->id }}" class="text-sm font-sans text-caixaAzul h-full px-3 focus:outline-none" >
                                        <i class="fas fa-chevron-down md:mr-2" x-bind:class="{ 'hidden': !exibirLinhasFilhas{{ $item->id }} }" x-show="!exibirLinhasFilhas{{ $item->id }}"></i>
                                        <i class="fas fa-chevron-up md:mr-2 hidden" x-bind:class="{ 'hidden': exibirLinhasFilhas{{ $item->id }} }" x-show="exibirLinhasFilhas{{ $item->id }}"></i>
                                    </button>
                                @endif
                            </td>
                            <td class="px-2 py-2">{{ $item->descricao }}</td>
                            <td class="w-1/5 px-2 py-2">
                                <div class="flex flex-nowrap justify-start">
                                    <span class="bg-blue-400 text-white p-1 rounded leading-none items-center text-sm table-cell mr-2">
                                        {{ $item->itensFilhos->count() }}
                                    </span>
                                    <button wire:click="adicionarItem(true, {{ $item->id }})" wire:loading.attr="disabled" class="text-sm font-sans text-caixaAzul h-full px-3 focus:outline-none border" ><i class="fas fa-plus md:mr-1"></i><div class="hidden md:inline-block">Adicionar Subitem</div></button>
                                </div>
                            </td>
                            <td class="px-2 py-2 w-1/5">
                                @if ($item->situacao)
                                    <span class="bg-green-600 text-white p-1 rounded leading-none items-center text-sm table-cell">
                                        Ativado
                                    </span>
                                @else
                                    <span class="bg-red-600 text-white p-1 rounded leading-none items-center text-sm table-cell">
                                        Desativado
                                    </span>
                                @endif
                            </td>
                            <td class="w-1/5 px-2 py-2">
                                <div class="flex flex-nowrap">
                                    <button 
                                        wire:click="editar({{ $item->id }})"
                                        wire:loading.attr="disabled"
                                        class="border-solid border border-white text-sm font-sans bg-white text-caixaAzul px-3 hover:border-gray focus:outline-none" >
                                        <i class="fas fa-edit"></i>
                                </button>
                                    <button 
                                        wire:click="$emit('triggerDelete',[{{ $item->id }},'O item e seus subitens serão excluídos'])"
                                        wire:loading.attr="disabled"
                                        class="border-solid border border-white text-sm font-sans bg-white text-red px-3 hover:border-gray focus:outline-none" >
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @foreach($item->itensFilhos->sortBy('ordem') as $item_filho)
                            <tr class="border-b @if(!$exibir_filhos) hidden @endif exibirLinhasFilhas{{ $item->id }}">
                                <td class="border-l-8 border-0 px-2 py-2 whitespace-no-wrap" style="border-color: {{ $item->cor }}">
                                    <div class="w-full border-l-4 border-0 px-2" style="border-color: {{ $item->cor }}">
                                        {{ $item_filho->nome }}
                                    </div>
                                </td>
                                <td class="px-2 py-2" colspan="2">{{ $item_filho->descricao }}</td>
                                <td class="px-2 py-2 w-1/5">
                                    @if ($item_filho->situacao)
                                        <span class="bg-green-600 text-white p-1 rounded leading-none items-center text-sm table-cell">
                                            Ativado
                                        </span>
                                    @else
                                        <span class="bg-red-600 text-white p-1 rounded leading-none items-center text-sm table-cell">
                                            Desativado
                                        </span>
                                    @endif
                                </td>
                                <td class="w-1/5 px-2 py-2">
                                    <div class="flex flex-nowrap">
                                        <button 
                                            wire:click="editar({{ $item_filho->id }})"
                                            wire:loading.attr="disabled"
                                            class="border-solid border border-white text-sm font-sans bg-white text-caixaAzul px-3 hover:border-gray focus:outline-none" >
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button 
                                            wire:click="$emit('triggerDelete',[{{ $item_filho->id }},'O item será excluído'])"
                                            wire:loading.attr="disabled"
                                            class="border-solid border border-white text-sm font-sans bg-white text-red px-3 hover:border-gray focus:outline-none" >
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
    <div class="@if($exibirModal) blocker @else hide @endif">
        <div class="p-6 modal w-4/6" id="modal-atendimento-tipo-form" @if($exibirModal)style="display: inline-block;"@endif>
            <div class="flex justify-between items-center pb-3">
                <p class="text-caixaAzul font-futurabold text-lg">Item de Checklist @if($isSubItem) - Subitem @endif</p>
                <div class="cursor-pointer z-50" wire:click="botaoCancelar">
                    <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                        <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                    </svg>
                </div>
            </div>
            <form>
                <div class="text-sm mb-2">
                    @if($isSubItem)
                    <div class="grid grid-flow-col auto-cols-max gap-4 mb-4 text-caixaAzul">
                        <x-form.input-text label="Item" value="{{ $item_pai->nome }}" placeholder="" readonly></x-form.input-text>
                        <label class="inline-block">
                            <span class="text-gray-700">Cor</span>
                            <input
                                value="{{ $item_pai->cor }}" 
                                type="color"
                                class="text-sm mt-3 block w-16"
                                autocomplete="off"
                                disabled
                                >
                        </label>
                    </div>
                    @endif
                    <div class="grid grid-flow-col auto-cols-max gap-4">
                        <x-form.input-text label="Nome" wire:model.debounce.lazy="item.nome" placeholder="">
                            @error('item.nome') <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">{{ $message }}</span>@enderror
                        </x-form.input-text>
                        <x-form.input-text type="number" label="Ordenação" wire:model.debounce.lazy="item.ordem" placeholder="">
                            @error('item.ordem') <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">{{ $message }}</span>@enderror
                        </x-form.input-text>
                    </div>
                    <div class="grid grid-flow-col auto-cols-max gap-4">
                        <label class="block">
                            <span class="text-gray-700 block">Situação</span>
                            <div class="switch switch--horizontal">
                                <input id="radio-a" type="radio" name="first-switch" value="0" wire:model.debounce.defer="item.situacao"/>
                                <label for="radio-a">Desativado</label>
                                <input id="radio-b" type="radio" name="first-switch" value="1" wire:model.debounce.defer="item.situacao"/>
                                <label for="radio-b">Ativado</label><span class="toggle-outside"><span class="toggle-inside"></span></span>
                            </div>
                            @error('item.situacao') <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">{{ $message }}</span>@enderror
                        </label>
                        @if(!$isSubItem)
                        <label class="block">
                            <span class="text-gray-700">Cor</span>
                            <input
                                wire:model.debounce.defer="item.cor" 
                                type="color"
                                class="text-sm mt-3 block w-16"
                                autocomplete="off"
                                >
                                @error('item.cor') <span class="text-red-500">{{ $message }}</span>@enderror
                        </label>
                        @endif
                    </div>
                    <div class="grid grid-cols-1 gap-3 mt-4">
                        <label class="block">
                            <span class="text-gray-700">Descrição</span>
                            <textarea wire:model.debounce.defer="item.descricao" class="mt-0 block w-full px-0.5 border-0 border-b-2 border-gray-200 focus:ring-0 focus:border-caixaAzul text-sm" rows="2"></textarea>
                            @error('item.descricao') <span class="text-red-500">{{ $message }}</span>@enderror
                        </label>
                    </div>
                </div>
                <div class="flex justify-between pt-2">
                    <button wire:click.prevent="botaoCancelar" wire:loading.attr="disabled" class="border-solid border border-gray-400 text-sm font-sans bg-caixaCinza bg-opacity-90 text-gray-500 px-3 py-1 hover:bg-opacity-100 focus:outline-none min-w-[75px]" >Cancelar</button>
                    <button wire:click.prevent="salvar" wire:loading.attr="disabled" class="border-solid border border-caixaLaranja text-sm font-sans bg-caixaLaranja bg-opacity-90 text-white px-3 py-1 hover:bg-opacity-100 focus:outline-none min-w-[75px]">Gravar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@push('scripts')
    <script>

        window.addEventListener('triggerMensagemSucesso', event => {
            toastr.success(event.detail);
        });
        
        Livewire.on('triggerDelete', ([itemId, mensagem]) => {
            console.log(itemId);
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

