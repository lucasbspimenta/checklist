<div>
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
                <button wire:click="$set('exibirModal', 'true')" class="border-solid border border-caixaLaranja text-sm font-sans bg-caixaLaranja bg-opacity-90 text-white h-3/4 px-3 hover:bg-opacity-100 focus:outline-none" ><i class="fas fa-plus md:mr-2"></i><div class="hidden md:inline-block">Adicionar</div></button>
            </div>
        </div>
    </nav>
    <div class="container mx-auto h-auto py-3 px-2">
        <div class="overflow-x-auto bg-white shadow overflow-y-auto relative">
            <table id="table_atendimento_tipo" class="w-full tr-even:bg-grey-200 border-collapse table-auto whitespace-no-wrap bg-white table-striped relative">
                <thead>
                    <tr>
                        <th class="px-6 py-2 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">Cód</th>
                        <th class="px-6 py-2 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">Cor</th>
                        <th class="px-6 py-2 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">Nome</th>
                        <th class="px-6 py-2 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">Descrição</th>
                        <th class="px-6 py-2 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">Situação</th>
                        <th class="px-6 py-2 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">Opções</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tipos as $tipo)
                    <tr>
                        <td class="border-solid border-t border-gray-200 text-sm px-6 py-2 whitespace-no-wrap">{{ $tipo->id }}</td>
                        <td class="border-solid border-t border-gray-200 text-sm px-6 py-2 whitespace-no-wrap"><span class="w-4 h-4 inline-block" style="background-color: {{ $tipo->cor }};"></span></td>
                        <td class="border-solid border-t border-gray-200 text-sm px-6 py-2 whitespace-no-wrap">{{ $tipo->nome }}</td>
                        <td class="border-solid border-t border-gray-200 text-sm px-6 py-2 whitespace-no-wrap">{{ $tipo->descricao }}</td>
                        <td class="border-solid border-t border-gray-200 text-sm px-6 py-2 whitespace-no-wrap">
                            @if ($tipo->situacao)
                                <span class="bg-green-600 text-white p-1 rounded leading-none items-center text-sm table-cell">
                                    Ativado
                                </span>
                            @else
                                <span class="bg-red-600 text-white p-1 rounded leading-none items-center text-sm table-cell">
                                    Desativado
                                </span>
                            @endif
                            
                        </td>
                        <td class="border-solid border-t border-gray-200 text-sm px-6 py-2 whitespace-no-wrap">
                            <div class="flex flex-nowrap">
                                <button 
                                    data-toggle="modal" data-target="#updateModal" wire:click="editar({{ $tipo->id }})"
                                    class="border-solid border border-white text-sm font-sans bg-white text-caixaAzul px-3 hover:border-gray focus:outline-none" >
                                    <i class="fas fa-edit"></i>
                            </button>
                                <button 
                                    wire:click="$emit('triggerDelete',{{ $tipo->id }})"
                                    class="border-solid border border-white text-sm font-sans bg-white text-red px-3 hover:border-gray focus:outline-none" >
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="@if($exibirModal) blocker @else hide @endif">
        <div class="p-6 modal w-4/6" id="modal-atendimento-tipo-form" @if($exibirModal)style="display: inline-block;"@endif>
            <div class="flex justify-between items-center pb-3">
                <p class="text-caixaAzul font-futurabold text-lg">Tipo de Agendamento</p>
                <div class="cursor-pointer z-50" wire:click="botaoCancelar">
                    <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                        <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                    </svg>
                </div>
            </div>
            <form>
                <div class="text-sm mb-2">
                    <div class="grid grid-cols-3 gap-4">
                        <x-form.input-text label="Nome" wire:model.debounce.lazy="tipo.nome" placeholder="">
                            @error('tipo.nome') <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">{{ $message }}</span>@enderror
                        </x-form.input-text>
                        <label class="block">
                            <span class="text-gray-700 block">Situação</span>
                            <div class="switch switch--horizontal">
                                <input id="radio-a" type="radio" name="first-switch" value="0" wire:model="tipo.situacao"/>
                                <label for="radio-a">Desativado</label>
                                <input id="radio-b" type="radio" name="first-switch" value="1" wire:model="tipo.situacao"/>
                                <label for="radio-b">Ativado</label><span class="toggle-outside"><span class="toggle-inside"></span></span>
                            </div>
                            @error('tipo.situacao') <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">{{ $message }}</span>@enderror
                        </label>
                        <label class="block">
                            <span class="text-gray-700">Cor</span>
                            <input
                                wire:model.debounce.defer="tipo.cor" 
                                type="color"
                                class="text-sm mt-3 block w-16"
                                autocomplete="off"
                                >
                                @error('tipo.cor') <span class="text-red-500">{{ $message }}</span>@enderror
                        </label>
                    </div>
                    <div class="grid grid-cols-1 gap-3 mt-4">
                        <label class="block">
                            <span class="text-gray-700">Descrição</span>
                            <textarea wire:model.debounce.defer="tipo.descricao" class="mt-0 block w-full px-0.5 border-0 border-b-2 border-gray-200 focus:ring-0 focus:border-caixaAzul" rows="2"></textarea>
                            @error('tipo.descricao') <span class="text-red-500">{{ $message }}</span>@enderror
                        </label>
                    </div>
                </div>
                <div class="flex justify-between pt-2">
                    <button wire:click.prevent="botaoCancelar" class="border-solid border border-gray-400 text-sm font-sans bg-caixaCinza bg-opacity-90 text-gray-500 px-3 py-1 hover:bg-opacity-100 focus:outline-none min-w-[75px]" >Cancelar</button>
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
        
        Livewire.on('triggerDelete', tipoId => {
            Swal.fire({
                    title: 'Você tem certeza?',
                    text: 'Tipo de Agendamento será excluído!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Sim, tenho certeza!',
                    cancelButtonText: 'Não'
                }).then((result) => {
                    if (result.value) {
                        @this.call('delete',tipoId)
                        @this.emit('loadTipos');
                    } else {
                        console.log("Canceled");
                    }
                });
        })
        
    </script>
@endpush
