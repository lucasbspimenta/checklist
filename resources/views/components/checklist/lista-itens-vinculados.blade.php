<div class="w-full h-auto mt-4 ">
    <table id="table_itens_checklist" class="relative w-full whitespace-no-wrap bg-white border-collapse table-fixed table-striped">
        <tbody class="mt-2 text-sm">
            @forelse($checklist->macroitens->sortBy('ordem') as $macroitem)
                <tr class="border-t border-b border-r" x-init="() => { exibirLinhasFilhas{{ $macroitem->id }}: false }">
                    <td class="px-2 py-2 whitespace-no-wrap border-0 border-l-8" style="border-color: {{ $macroitem->cor }}">
                        <b>{{ $macroitem->nome }}</b>
                        @if($macroitem->itensFilhos->count() > 0)
                            <div onClick="$('.exibirLinhasFilhas{{ $macroitem->id }}').toggleClass('hidden');" @click="exibirLinhasFilhas{{ $macroitem->id }} = !exibirLinhasFilhas{{ $macroitem->id }}" class="inline-block h-full px-3 font-sans text-sm leading-6 cursor-pointer text-caixaAzul focus:outline-none" >
                                <i class="fas fa-chevron-down md:mr-2" x-bind:class="{ 'hidden': !exibirLinhasFilhas{{ $macroitem->id }} }" x-show="!exibirLinhasFilhas{{ $macroitem->id }}"></i>
                                <i class="hidden fas fa-chevron-up md:mr-2" x-bind:class="{ 'hidden': exibirLinhasFilhas{{ $macroitem->id }} }" x-show="exibirLinhasFilhas{{ $macroitem->id }}"></i>
                            </div>
                        @endif
                    </td>
                    <td class="px-2 py-2">&nbsp;</td>
                    <td class="px-2 py-2">&nbsp;</td>
                </tr>
                @foreach($checklist->respostas->where('item_pai_id', $macroitem->id)->sortBy('ordem') as $item_filho)
                    <tr class="border-b border-r exibirLinhasFilhas{{ $macroitem->id }} hover:bg-gray-50" x-data="{situacao_{{ $item_filho->id }}: {{ $item_filho->resposta ?? '\'\'' }}}">
                        <td class="w-auto px-2 py-2 whitespace-no-wrap border-0 border-l-8" style="border-color: {{ $macroitem->cor }}">
                            <div class="w-full px-2 border-0 border-l-4" style="border-color: {{ $macroitem->cor }}">
                                {{ $item_filho->item->nome }}
                            </div>
                        </td>
                        <td class="w-20 px-2 py-2 whitespace-no-wrap">
                            <div class="switch switch--horizontal"  x-init="$watch('situacao_{{ $item_filho->id }}', value => console.log(value))">
                                <input {{ $item_filho->resposta == -1 ? 'checked' : '' }} id="radio-inconforme-{{ $item_filho->id }}" type="radio" name="resposta[{{ $item_filho->id }}]" value="-1" x-model="situacao_{{ $item_filho->id }}" />
                                <label for="radio-inconforme-{{ $item_filho->id }}">Inconforme</label>
                                <input {{ $item_filho->resposta == 1 ? 'checked' : '' }} id="radio-conforme-{{ $item_filho->id }}" type="radio" name="resposta[{{ $item_filho->id }}]" value="1" x-model="situacao_{{ $item_filho->id }}"/>
                                <label for="radio-conforme-{{ $item_filho->id }}">Conforme</label>
                                <input {{ $item_filho->resposta == 0 ? 'checked' : '' }} id="radio-naoseaplica-{{ $item_filho->id }}" type="radio" name="resposta[{{ $item_filho->id }}]" value="0" x-model="situacao_{{ $item_filho->id }}"/>
                                <label for="radio-naoseaplica-{{ $item_filho->id }}">Não se aplica</label>
                                <input {{ is_null($item_filho->resposta) ? 'checked' : '' }} class="hidden" id="radio-naoselecionado-{{ $item_filho->id }}" type="radio" name="resposta[{{ $item_filho->id }}]" value="" x-model="situacao_{{ $item_filho->id }}"/>
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
