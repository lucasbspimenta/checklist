<form wire:submit.prevent="save" enctype="multipart/form-data">
    <div class="block w-20 mr-4">
        <div class="py-1 text-center text-gray-700 border-t-4" style="border-color: {{ $resposta->item->cor ?? $resposta->item->itempai->cor }}">
            <p id="caption" class="text-sm">{{ $resposta->item->nome }}</p>
        </div>

        @if($resposta->foto)
            <a class="image-popup-link" href="{{ $resposta->foto ? $resposta->foto : asset('images/image_placeholder.jpg') }}">
                <img alt="{{ $resposta->item->nome ?? '' }}" class="w-20 h-14" src="{{ $resposta->foto ? $resposta->foto : asset('images/image_placeholder.jpg') }}" />
            </a>
            @if($checklist->concluido != 1)
                <div class="text-sm text-center">
                    <button 
                        class="w-full h-full px-1 py-1 font-sans text-xs text-white bg-red-600 border border-red-600 border-solid bg-opacity-90 hover:bg-opacity-100 focus:outline-none" >
                        <i class="fas fa-trash md:mr-2"></i>
                        <div wire:click.prevent="excluirFoto" class="hidden md:inline-block">excluir</div>
                    </button>
                </div>
            @endif
        @else
            <label for="fileUpload_{{ $resposta->id }}" class="cursor-pointer">
                <img alt="{{ $resposta->item->nome ?? '' }}" class="w-20 h-14" src="{{ $resposta->foto ? $resposta->foto : asset('images/image_placeholder.jpg') }}" />
                @if($checklist->concluido != 1)
                    <div class="text-sm text-center">
                        <label for="fileUpload_{{ $resposta->id }}" class="inline-flex items-center w-full h-full px-1 py-1 text-xs text-white cursor-pointer bg-caixaLaranja">
                            <i class="fas fa-upload md:mr-2"></i>
                            <span class="ml-2">Enviar</span>
                        </label>
                        <input onChange="this.submit()" id="fileUpload_{{ $resposta->id }}" class="invisible hidden w-0 h-0 overflow-hidden" wire:model="photo" type="file" accept=".png, .jpg, .jpeg"/>
                    </div>
                @endif
            </label>
        @endif
        @error('photo') <span class="error">{{ $message }}</span> @enderror
    </div>
</form>