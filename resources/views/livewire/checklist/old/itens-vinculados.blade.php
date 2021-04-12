<div class="w-full h-auto mt-4 ">
    <table id="table_itens_checklist" class="relative w-full whitespace-no-wrap bg-white border-collapse table-fixed table-striped">
        <tbody class="mt-2 text-sm">
            @forelse($agenda->checklist->macroitens->sortBy('ordem') as $macroitem)
                <tr class="border-t border-b border-r" x-init="() => { exibirLinhasFilhas{{ $macroitem->id }}: false }">
                    <td class="px-2 py-2 whitespace-no-wrap border-0 border-l-8" style="border-color: {{ $macroitem->cor }}">
                        <b>{{ $macroitem->nome }}</b>
                        @if($macroitem->itensFilhos->count() > 0)
                            <button onClick="$('.exibirLinhasFilhas{{ $macroitem->id }}').toggleClass('hidden');" @click="exibirLinhasFilhas{{ $macroitem->id }} = !exibirLinhasFilhas{{ $macroitem->id }}" class="h-full px-3 font-sans text-sm text-caixaAzul focus:outline-none" >
                                <i class="fas fa-chevron-down md:mr-2" x-bind:class="{ 'hidden': !exibirLinhasFilhas{{ $macroitem->id }} }" x-show="!exibirLinhasFilhas{{ $macroitem->id }}"></i>
                                <i class="hidden fas fa-chevron-up md:mr-2" x-bind:class="{ 'hidden': exibirLinhasFilhas{{ $macroitem->id }} }" x-show="exibirLinhasFilhas{{ $macroitem->id }}"></i>
                            </button>
                        @endif
                    </td>
                    <td class="px-2 py-2">&nbsp;</td>
                    <td class="px-2 py-2">&nbsp;</td>
                </tr>
                @foreach($agenda->checklist->itens->where('item_pai_id', $macroitem->id)->sortBy('ordem') as $item_filho)
                    <tr class="border-b border-r exibirLinhasFilhas{{ $macroitem->id }} hover:bg-gray-50" x-data="{situacao_{{ $item_filho->id }}: 0}">
                        <td class="w-auto px-2 py-2 whitespace-no-wrap border-0 border-l-8" style="border-color: {{ $macroitem->cor }}">
                            <div class="w-full px-2 border-0 border-l-4" style="border-color: {{ $macroitem->cor }}">
                                {{ $item_filho->nome }}
                            </div>
                        </td>
                        <td class="w-20 px-2 py-2 whitespace-no-wrap">
                            <div class="switch switch--horizontal"  x-init="$watch('situacao_{{ $item_filho->id }}', value => console.log(value))">
                                <input wire:model.defer="itens_situacoes.{{ $item_filho->id }}" id="radio-inconforme-{{ $item_filho->id }}" type="radio" name="radio-situacao-{{ $item_filho->id }}" value="-1" x-model="situacao_{{ $item_filho->id }}"/>
                                <label for="radio-inconforme-{{ $item_filho->id }}">Inconforme</label>
                                <input wire:model.defer="itens_situacoes.{{ $item_filho->id }}" id="radio-conforme-{{ $item_filho->id }}" type="radio" name="radio-situacao-{{ $item_filho->id }}" value="1" x-model="situacao_{{ $item_filho->id }}"/>
                                <label for="radio-conforme-{{ $item_filho->id }}">Conforme</label>
                                <input wire:model.defer="itens_situacoes.{{ $item_filho->id }}" id="radio-naoseaplica-{{ $item_filho->id }}" type="radio" name="radio-situacao-{{ $item_filho->id }}" value="0" x-model="situacao_{{ $item_filho->id }}"/>
                                <label for="radio-naoseaplica-{{ $item_filho->id }}">Não se aplica</label>
                                
                                <input class="hidden" wire:model.defer="itens_situacoes.{{ $item_filho->id }}" id="radio-naoselecionado-{{ $item_filho->id }}" type="radio" name="radio-situacao-{{ $item_filho->id }}" value="" x-model="situacao_{{ $item_filho->id }}"/>

                                <input type="text" wire:model="agenda.checklist.itens.{{ $item_filho->id }}.resposta" />
                            </div>
                        </td>
                        <td class="w-6 px-2 py-2 whitespace-no-wrap">
                            <button
                                style="display: none"
                                x-show="situacao_{{ $item_filho->id }} == '-1'"
                                wire:click="salvar" 
                                class="inline-block float-right h-full px-3 font-sans text-sm border text-caixaAzul focus:outline-none hover:bg-caixaLaranja hover:text-white" >
                                    <i class="fas fa-plus md:mr-1"></i><div class="hidden md:inline-block">Abrir demanda</div>
                            </button>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <th colspan="3" class="bg-[#FCFCFC]">&nbsp;</th>
                </tr>
            @empty
                <tr>
                    <th>Nenhum registro localizado</th>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
