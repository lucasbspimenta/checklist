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
                    <label class="block">
                        <span class="text-gray-700">Cód</span>
                        <p>{{ $agenda->id ?? '' }}</p>
                    </label>
                    <label class="block">
                        <span class="text-gray-700">Início</span>
                        <p>{{ $agenda->inicio ?? '' }}</p>
                    </label>
                    <label class="block">
                        <span class="text-gray-700">Final</span>
                        <p>{{ $agenda->final ?? '' }}</p>
                    </label>
                </div>
                <div class="grid grid-cols-1 gap-3 mt-4">
                    <label class="block">
                        <span class="text-gray-700">Imóvel</span>
                        <p>{{ $agenda->imovel_id  ?? '' }}</p>
                    </label>
                    <label class="block">
                        <span class="text-gray-700">Tipo</span>
                        <p><div style="height: 20px; ">{{ $agenda->tipo->cor ?? '' }}</div>{{ $agenda->tipo->nome ?? '' }}</p>
                    </label>
                    <label class="block">
                        <span class="text-gray-700">Descrição</span>
                        <p>{{ $agenda->descricao ?? '' }}</p>
                    </label>
                </div>
            </div>
            <div class="flex justify-between pt-2">
                <button wire:click.prevent="botaoCancelar" wire:loading.attr="disabled" class="border-solid border border-gray-400 text-sm font-sans bg-caixaCinza bg-opacity-90 text-gray-500 px-3 py-1 hover:bg-opacity-100 focus:outline-none min-w-[75px]" >Fechar</button>
                <button wire:click.prevent="excluir({{ $agenda->id }})" wire:loading.attr="disabled" class="border-solid border border-red-800 text-sm font-sans bg-red-800 bg-opacity-90 text-white px-3 py-1 hover:bg-opacity-100 focus:outline-none min-w-[75px]">Remover</button>
                @if($conta_itens_ativos > 0)
                <a href="{{ route('checklist.edit', ($agenda->id ?? 'novo')) }}" wire:loading.attr="disabled" class="border-solid border border-caixaLaranja text-sm font-sans bg-caixaLaranja bg-opacity-90 text-white px-3 py-1 hover:bg-opacity-100 focus:outline-none min-w-[75px] leading-6" >Checklist</a>
                @endif
            </div>
        </form>
    </div>
</div>