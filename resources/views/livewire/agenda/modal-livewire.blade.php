<div class="@if($exibirModal) blocker @else hide @endif">
    <div class="w-4/6 p-6 modal" id="modal-atendimento-tipo-form" @if($exibirModal)style="display: inline-block;"@endif>
        <div class="flex items-center justify-between pb-3">
            <p class="text-lg text-caixaAzul font-futurabold">Agendamento</p>
            <div class="z-50 cursor-pointer" wire:click="botaoCancelar">
                <svg class="text-black fill-current" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                    <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                </svg>
            </div>
        </div>
        <form>
            <div class="mb-2 text-sm">
                <div class="grid grid-flow-col gap-4 auto-cols-max">
                    <x-form.input-text type="date" label="Início" wire:model="agenda.inicio" placeholder="">
                        @error('agenda.inicio') <span class="flex items-center mt-1 ml-1 text-xs font-medium tracking-wide text-red-500">{{ $message }}</span>@enderror
                    </x-form.input-text>
                    <x-form.input-text type="date" label="Final" wire:model="agenda.final" placeholder="">
                        @error('agenda.final') <span class="flex items-center mt-1 ml-1 text-xs font-medium tracking-wide text-red-500">{{ $message }}</span>@enderror
                    </x-form.input-text>
                </div>
                <div class="grid grid-cols-1 gap-3 mt-4">
                    <label class="block">
                        <span class="text-gray-700">Imóvel</span>
                        <select class="w-full" wire:model.debounce.defer="agenda.imovel_id">
                            <option value="" >Selecione o imóvel</option>
                            <option value="1">Ag. Divinópolis</option>
                            <option value="2">Ag. Lucas do Divinópolis</option>
                        </select>
                        @error('agenda.imovel_id') <span class="text-red-500">{{ $message }}</span>@enderror
                    </label>
                    <label class="block">
                        <span class="text-gray-700">Tipo de Agendamento</span>
                        <select class="w-full" wire:model.debounce.defer="agenda.agendamento_tipos_id">
                                <option value="" >Selecione o tipo de agendamento</option>
                            @forelse($tiposagendamentos as $tipo)
                                <option value="{{ $tipo->id }}">{{ $tipo->nome }}</option>
                            @empty
                                <option value="" disabled>Nenhum tipo de agendamento cadastrado</option>
                            @endforelse
                        </select>
                        @error('agenda.agendamento_tipos_id') <span class="text-red-500">{{ $message }}</span>@enderror
                    </label>
                    <label class="block">
                        <span class="text-gray-700">Descrição</span>
                        <textarea wire:model.debounce.defer="agenda.descricao" class="mt-0 block w-full px-0.5 border-0 border-b-2 border-gray-200 focus:ring-0 focus:border-caixaAzul text-sm" rows="2"></textarea>
                        @error('agenda.descricao') <span class="text-red-500">{{ $message }}</span>@enderror
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