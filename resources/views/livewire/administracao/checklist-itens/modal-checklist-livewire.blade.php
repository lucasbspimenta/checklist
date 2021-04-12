<div class="@if($exibirModal) blocker @else hide @endif">
    <div class="w-4/6 p-6 modal" id="modal-atendimento-tipo-form" @if($exibirModal)style="display: inline-block;"@endif>
        <div class="flex items-center justify-between pb-3">
            <p class="text-lg text-caixaAzul font-futurabold">Item de Checklist @if($checklistitem->itempai) - Subitem @endif</p>
            <div class="z-50 cursor-pointer" wire:click="botaoCancelar">
                <svg class="text-black fill-current" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                    <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                </svg>
            </div>
        </div>
        <form>
            <div class="mb-2 text-sm">
                @if($checklistitem->itempai)
                <div class="grid grid-flow-col gap-4 mb-4 auto-cols-max text-caixaAzul">
                    <x-form.input-text label="Item" value="{{ $checklistitem->itempai->nome }}" placeholder="" readonly></x-form.input-text>
                    <label class="inline-block">
                        <span class="text-gray-700">Cor</span>
                        <input
                            value="{{ $checklistitem->itempai->cor }}" 
                            type="color"
                            class="block w-16 mt-3 text-sm"
                            autocomplete="off"
                            disabled
                            >
                    </label>
                </div>
                @endif
                <div class="grid grid-flow-col gap-4 auto-cols-max">
                    <x-form.input-text label="Nome" wire:model.debounce.lazy="checklistitem.nome" placeholder="">
                        @error('checklistitem.nome') <span class="flex items-center mt-1 ml-1 text-xs font-medium tracking-wide text-red-500">{{ $message }}</span>@enderror
                    </x-form.input-text>
                    <x-form.input-text type="number" label="Ordenação" wire:model.debounce.defer="checklistitem.ordem" placeholder="">
                        @error('checklistitem.ordem') <span class="flex items-center mt-1 ml-1 text-xs font-medium tracking-wide text-red-500">{{ $message }}</span>@enderror
                    </x-form.input-text>
                    
                </div>
                <div class="grid grid-flow-col gap-4 auto-cols-max">
                    <label class="block">
                        <span class="block text-gray-700">Situação</span>
                        <div>
                            <input id="radio-a" type="radio" name="radio-situacao" value="D" wire:model.debounce.defer="checklistitem.situacao"/>
                            <label for="radio-a">Desativado</label>
                            <input id="radio-b" type="radio" name="radio-situacao" value="A" wire:model.debounce.defer="checklistitem.situacao"/>
                            <label for="radio-b">Ativado</label>
                            <input id="radio-default" type="radio" name="radio-foto" value="" wire:model.debounce.defer="checklistitem.situacao"/>
                        </div>
                        @error('checklistitem.situacao') <span class="flex items-center mt-1 ml-1 text-xs font-medium tracking-wide text-red-500">{{ $message }}</span>@enderror
                    </label>
                    @if(!$checklistitem->itempai)
                    <label class="block">
                        <span class="text-gray-700">Cor</span>
                        <input
                            wire:model.debounce.defer="checklistitem.cor" 
                            type="color"
                            class="block w-16 mt-3 text-sm"
                            autocomplete="off"
                            >
                            @error('checklistitem.cor') <span class="text-red-500">{{ $message }}</span>@enderror
                    </label>
                    @endif
                    <label class="block">
                        <span class="block text-gray-700">Foto obrigatória</span>
                        <div>
                            <input id="radio-foto-nao" type="radio" name="radio-foto" value="N" wire:model.debounce.defer="checklistitem.foto"/>
                            <label for="radio-foto-nao">Não</label>
                            <input id="radio-foto-sim" type="radio" name="radio-foto" value="S" wire:model.debounce.defer="checklistitem.foto"/>
                            <label for="radio-foto-sim">Sim</label>
                            <input id="radio-default" type="radio" name="radio-foto" value="" wire:model.debounce.defer="checklistitem.foto"/>
                        </div>
                        @error('checklistitem.foto') <span class="flex items-center mt-1 ml-1 text-xs font-medium tracking-wide text-red-500">{{ $message }}</span>@enderror
                    </label>
                </div>
                <div class="grid grid-cols-1 gap-3 mt-4">
                    <label class="block">
                        <span class="text-gray-700">Descrição</span>
                        <textarea wire:model.debounce.defer="checklistitem.descricao" class="mt-0 block w-full px-0.5 border-0 border-b-2 border-gray-200 focus:ring-0 focus:border-caixaAzul text-sm" rows="2"></textarea>
                        @error('checklistitem.descricao') <span class="text-red-500">{{ $message }}</span>@enderror
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