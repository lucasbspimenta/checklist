<div class="w-full h-auto mt-4 ">
    <table id="table_itens_checklist" class="relative w-full whitespace-no-wrap bg-white border-collapse table-fixed table-striped">
        <tbody class="mt-2 text-sm">
            @forelse($checklist->macroitens->sortBy('ordem') as $macroitem)
                <tr class="border-t border-b border-r" x-init="() => { exibirLinhasFilhas{{ $macroitem->id }}: false }">
                    <td class="px-2 py-2 whitespace-no-wrap border-0 border-l-8" style="border-color: {{ $macroitem->cor }}">
                        <b>{{ $macroitem->nome }}</b>
                        @if( $macroitem->foto == 'S')
                            <i class="mx-2 font-bold text-gray-500 fas fa-camera"></i>
                        @endif
                        @if($macroitem->itensFilhos->count() > 0)
                            <div onClick="$('.exibirLinhasFilhas{{ $macroitem->id }}').toggleClass('hidden');" @click="exibirLinhasFilhas{{ $macroitem->id }} = !exibirLinhasFilhas{{ $macroitem->id }}" class="inline-block h-full px-3 font-sans text-sm leading-6 cursor-pointer text-caixaAzul focus:outline-none" >
                                <i class="fas fa-chevron-down md:mr-2" x-bind:class="{ 'hidden': !exibirLinhasFilhas{{ $macroitem->id }} }" x-show="!exibirLinhasFilhas{{ $macroitem->id }}"></i>
                                <i class="hidden fas fa-chevron-up md:mr-2" x-bind:class="{ 'hidden': exibirLinhasFilhas{{ $macroitem->id }} }" x-show="exibirLinhasFilhas{{ $macroitem->id }}"></i>
                            </div>
                        @endif
                    </td>
                    <td class="w-8 px-2 py-2">
                        
                        @if($macroitem->concluidoNoChecklist($checklist->id))
                            <i class="font-bold text-green-900 fas fa-check"></i>
                        @else
                            <i class="font-bold text-gray-500 fas fa-hourglass-half"></i>
                        @endif
                    </td>
                    <td class="px-2 py-2">&nbsp;</td>
                    <td class="px-2 py-2">
                        
                    </td>
                </tr>
                @foreach($checklist->respostas->where('item_pai_id', $macroitem->id)->sortBy('ordem') as $item_filho)
                    
                    <tr class="border-b border-r exibirLinhasFilhas{{ $macroitem->id }} hover:bg-gray-50" x-data="{situacao_{{ $item_filho->id }}: {{ $item_filho->resposta ?? '\'\'' }}}">
                        <td class="w-auto px-2 py-2 whitespace-no-wrap border-0 border-l-8" style="border-color: {{ $macroitem->cor }}">
                            <div class="w-full px-2 border-0 border-l-4" style="border-color: {{ $macroitem->cor }}">
                                {{ $item_filho->item->nome }}
                                @if( $item_filho->item->foto == 'S')
                                    <i class="mx-2 font-bold text-gray-500 fas fa-camera"></i>
                                @endif
                            </div>
                        </td>
                        <td class="w-5 px-2 py-2">
                            @if( $item_filho->concluido)
                                <i class="font-bold text-green-900 fas fa-check-circle"></i>
                            @else
                            <i class="font-bold text-gray-500 fas fa-hourglass-half"></i>
                            @endif
                        </td>
                        <td class="w-20 px-2 py-2 text-center whitespace-no-wrap">
                            @if($checklist->concluido != 1)
                                <div class="switch switch--horizontal"  x-init="$watch('situacao_{{ $item_filho->id }}', value => console.log(value))">
                                    <input {{ $item_filho->resposta == -1 ? 'checked' : '' }} id="radio-inconforme-{{ $item_filho->id }}" type="radio" name="resposta[{{ $item_filho->id }}]" value="-1" x-model="situacao_{{ $item_filho->id }}" />
                                    <label class="disabled:opacity-30" for="radio-inconforme-{{ $item_filho->id }}">Inconforme</label>
                                    <input class="disabled:opacity-30" {{ ($item_filho->demandas_count && $item_filho->demandas_count > 0) ? 'disabled' : '' }} {{ $item_filho->resposta == 1 ? 'checked' : '' }} id="radio-conforme-{{ $item_filho->id }}" type="radio" name="resposta[{{ $item_filho->id }}]" value="1" x-model="situacao_{{ $item_filho->id }}"/>
                                    <label {{ ($item_filho->demandas_count && $item_filho->demandas_count > 0) ? 'class=opacity-30' : '' }} for="radio-conforme-{{ $item_filho->id }}">Conforme</label>
                                    <input class="disabled:opacity-30" {{ ($item_filho->demandas_count && $item_filho->demandas_count > 0) ? 'disabled' : '' }} {{ $item_filho->resposta == 0 ? 'checked' : '' }} id="radio-naoseaplica-{{ $item_filho->id }}" type="radio" name="resposta[{{ $item_filho->id }}]" value="0" x-model="situacao_{{ $item_filho->id }}"/>
                                    <label {{ ($item_filho->demandas_count && $item_filho->demandas_count > 0) ? 'class=opacity-30' : '' }} for="radio-naoseaplica-{{ $item_filho->id }}">Não se aplica</label>
                                    <input class="disabled:opacity-0" {{ ($item_filho->demandas_count && $item_filho->demandas_count > 0) ? 'disabled' : '' }} {{ is_null($item_filho->resposta) ? 'checked' : '' }} class="hidden disabled:opacity-30" id="radio-naoselecionado-{{ $item_filho->id }}" type="radio" name="resposta[{{ $item_filho->id }}]" value="" x-model="situacao_{{ $item_filho->id }}"/>
                                </div>
                            @else
                                @switch($item_filho->resposta)
                                    @case(-1)
                                            <div class="float-right w-3/6 px-2 py-1 m-1 font-normal text-white bg-red-600 border border-red-600 right w-50">
                                                <div class="w-auto font-normal leading-none whitespace-nowrap">Inconforme</div>
                                            </div>
                                        @break
                                    @case(1)
                                            <div class="float-right w-3/6 px-2 py-1 m-1 font-normal text-white bg-green-600 border border-green-600 right w-50">
                                                <div class="w-auto font-normal leading-none whitespace-nowrap">Conforme</div>
                                            </div>
                                        @break

                                    @case(0)
                                    <div class="float-right w-3/6 px-2 py-1 m-1 font-normal text-gray-500 bg-gray-200 border border-gray-300 right w-50">
                                        <div class="w-auto font-normal leading-none whitespace-nowrap">Não se aplica</div>
                                    </div>
                                        @break
                                    @default
                                        
                                @endswitch
                                
                            @endif
                        </td>
                        <td class="px-2 py-2 whitespace-no-wrap w-36">
                            @if($checklist->concluido != 1)
                                <button
                                    style="display: none"
                                    x-show="situacao_{{ $item_filho->id }} == '-1'"
                                    x-on:click="AdicionarDemanda({{ $item_filho->id }})" 
                                    x-on:click.prevent
                                    class="inline-block float-right h-full px-3 font-sans text-sm border text-caixaAzul focus:outline-none hover:bg-caixaLaranja hover:text-white" >
                                        <i class="fas fa-plus md:mr-1"></i><div class="hidden md:inline-block">Abrir demanda</div>
                                </button>
                            @endif
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

