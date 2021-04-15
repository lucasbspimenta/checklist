<div>
    <div class="gmodal__header">
        <div class="gmodal__title">
            <p class="text-lg text-caixaAzul font-futurabold">Demanda</p>
        </div>
        <button type="button" class="gmodal__close" data-gmodal="dismiss">
            <svg width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6.34 6.34l11.32 11.32m-11.32 0L17.66 6.34"/>
        </svg>
        </button>
    </div>
    <div class="text-sm gmodal__body">
        <div class="grid grid-flow-row gap-4 auto-rows-max">
            <label class="block">
                <x-form.input-text label="Item" value="{{ $checklistItem->item->itempai->nome ?? '' }}&nbsp;&#10148;&nbsp;{{ $checklistItem->item->nome ?? '' }}" placeholder="" readonly></x-form.input-text>
            </label>
            <label class="block">
                <span class="text-gray-700">Destino</span>
                <select wire:model="sistemaSelecionado" wire:loading.attr="disabled" class="w-full">
                    <option value="" >Selecione o destino</option>
                    @forelse ($sistemas as $sistema)
                        <option value="{{ $sistema->id }}">{{ $sistema->nome }}</option>
                    @empty
                        <option value="" >Nenhum sistema cadastrado</option>
                    @endforelse
                </select>
                @error('sistemaSelecionado') <span class="text-red-500">{{ $message }}</span>@enderror
            </label>
            @if($this->sistemaSelecionado && $sistema->categorias_table && $sistema->categorias->count() > 0)
            <label class="block">
                <span class="text-gray-700">Categoria</span>
                <select wire:model="categoriaSelecionado" wire:loading.attr="disabled" class="w-full" >
                    <option value="" >Selecione a categoria</option>
                    @forelse ($sistema->categorias as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                    @empty
                        <option value="" >Nenhuma categoria cadastrado</option>
                    @endforelse
                </select>
                @error('categoriaSelecionado') <span class="text-red-500">{{ $message }}</span>@enderror
            </label>
            @endif
            @if($this->sistemaSelecionado && $sistema->subcategorias_table && $sistema->subcategorias->count() > 0)
            <label class="block">
                <span class="text-gray-700">Sub-Categoria</span>
                <select wire:model="subcategoriaSelecionado" wire:loading.attr="disabled" class="w-full">
                    <option value="" >Selecione a subcategoria</option>
                    @forelse ($sistema->subcategorias as $subcategoria)
                        <option value="{{ $subcategoria->id }}">{{ $subcategoria->nome }}</option>
                    @empty
                        <option value="" >Nenhuma subcategoria cadastrado</option>
                    @endforelse
                </select>
                @error('subcategoriaSelecionado') <span class="text-red-500">{{ $message }}</span>@enderror
            </label>
            @endif
            @if($this->sistemaSelecionado && $sistema->itens_table && $sistema->itens->count() > 0)
            <label class="block">
                <span class="text-gray-700">Item</span>
                <select wire:model.debounce.defer="itemSelecionado" wire:loading.attr="disabled" wire:target="subcategoriaSelecionado" wire:target="categoriaSelecionado" class="w-full">
                    <option value="" >Selecione o item</option>
                    @forelse ($sistema->itens as $item)
                        @if($categoriaSelecionado)
                            @if($item->categoria && $item->categoria == $categoriaSelecionado)
                                <option categoria="{{ $item->categoria }}" value="{{ $item->id }}">{{ $item->nome }}</option>
                            @endif
                        @else
                            <option value="{{ $item->id }}">{{ $item->nome }}</option>
                        @endif
                    @empty
                        <option value="" >Nenhuma categoria cadastrado</option>
                    @endforelse
                </select>
                @error('itemSelecionado') <span class="text-red-500">{{ $message }}</span>@enderror
            </label>
            @endif
            <label class="block">
                <span class="text-gray-700">Descrição</span>
                <textarea wire:model.debounce.defer="descricao" class="mt-0 block w-full px-0.5 border-0 border-b-2 border-gray-200 focus:ring-0 focus:border-caixaAzul text-sm" rows="2"></textarea>
                @error('descricao') <span class="text-red-500">{{ $message }}</span>@enderror
            </label>
        </div>
    </div>
    <div class="flex justify-between gmodal__footer">
        <button class="border-solid border border-gray-400 text-sm font-sans bg-caixaCinza bg-opacity-90 text-gray-500 px-3 py-1 hover:bg-opacity-100 focus:outline-none min-w-[75px]" data-gmodal="dismiss">Cancelar</button>
        <button wire:click="salvar" class="border-solid border border-caixaLaranja text-sm font-sans bg-caixaLaranja bg-opacity-90 text-white px-3 py-1 hover:bg-opacity-100 focus:outline-none min-w-[75px]">Gravar</button>
    </div>
</div>
