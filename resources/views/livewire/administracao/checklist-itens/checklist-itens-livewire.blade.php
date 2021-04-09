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
                <button wire:click="adicionarItem" wire:loading.attr="disabled" class="px-3 font-sans text-sm text-white border border-solid border-caixaLaranja bg-caixaLaranja bg-opacity-90 h-3/4 hover:bg-opacity-100 focus:outline-none" ><i class="fas fa-plus md:mr-2"></i><div class="hidden md:inline-block">Adicionar</div></button>
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
                            <td class="w-1/5 px-2 py-2">
                                <div class="flex justify-start flex-nowrap">
                                    <span class="items-center table-cell p-1 mr-2 text-sm leading-none text-white bg-blue-400 rounded">
                                        {{ $item->itensFilhos->count() }}
                                    </span>
                                    <button wire:click="adicionarItem(true, {{ $item->id }})" wire:loading.attr="disabled" class="h-full px-3 font-sans text-sm border text-caixaAzul focus:outline-none" ><i class="fas fa-plus md:mr-1"></i><div class="hidden md:inline-block">Adicionar Subitem</div></button>
                                </div>
                            </td>
                            <td class="w-1/5 px-2 py-2">
                                @if ($item->situacao)
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
                                        wire:click="editar({{ $item->id }})"
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
                                <td class="px-2 py-2" colspan="2">{{ $item_filho->descricao }}</td>
                                <td class="w-1/5 px-2 py-2">
                                    @if ($item_filho->situacao)
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
                                            wire:click="editar({{ $item_filho->id }})"
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
    <div class="@if($exibirModal) blocker @else hide @endif">
        <div class="w-4/6 p-6 modal" id="modal-atendimento-tipo-form" @if($exibirModal)style="display: inline-block;"@endif>
            <div class="flex items-center justify-between pb-3">
                <p class="text-lg text-caixaAzul font-futurabold">Item de Checklist @if($isSubItem) - Subitem @endif</p>
                <div class="z-50 cursor-pointer" wire:click="botaoCancelar">
                    <svg class="text-black fill-current" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                        <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                    </svg>
                </div>
            </div>
            <form>
                <div class="mb-2 text-sm">
                    @if($isSubItem)
                    <div class="grid grid-flow-col gap-4 mb-4 auto-cols-max text-caixaAzul">
                        <x-form.input-text label="Item" value="{{ $item_pai->nome }}" placeholder="" readonly></x-form.input-text>
                        <label class="inline-block">
                            <span class="text-gray-700">Cor</span>
                            <input
                                value="{{ $item_pai->cor }}" 
                                type="color"
                                class="block w-16 mt-3 text-sm"
                                autocomplete="off"
                                disabled
                                >
                        </label>
                    </div>
                    @endif
                    <div class="grid grid-flow-col gap-4 auto-cols-max">
                        <x-form.input-text label="Nome" wire:model.debounce.lazy="item.nome" placeholder="">
                            @error('item.nome') <span class="flex items-center mt-1 ml-1 text-xs font-medium tracking-wide text-red-500">{{ $message }}</span>@enderror
                        </x-form.input-text>
                        <x-form.input-text type="number" label="Ordenação" wire:model.debounce.lazy="item.ordem" placeholder="">
                            @error('item.ordem') <span class="flex items-center mt-1 ml-1 text-xs font-medium tracking-wide text-red-500">{{ $message }}</span>@enderror
                        </x-form.input-text>
                    </div>
                    <div class="grid grid-flow-col gap-4 auto-cols-max">
                        <label class="block">
                            <span class="block text-gray-700">Situação</span>
                            <div class="switch switch--horizontal">
                                <input id="radio-a" type="radio" name="first-switch" value="0" wire:model.debounce.defer="item.situacao"/>
                                <label for="radio-a">Desativado</label>
                                <input id="radio-b" type="radio" name="first-switch" value="1" wire:model.debounce.defer="item.situacao"/>
                                <label for="radio-b">Ativado</label><span class="toggle-outside"><span class="toggle-inside"></span></span>
                            </div>
                            @error('item.situacao') <span class="flex items-center mt-1 ml-1 text-xs font-medium tracking-wide text-red-500">{{ $message }}</span>@enderror
                        </label>
                        @if(!$isSubItem)
                        <label class="block">
                            <span class="text-gray-700">Cor</span>
                            <input
                                wire:model.debounce.defer="item.cor" 
                                type="color"
                                class="block w-16 mt-3 text-sm"
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

